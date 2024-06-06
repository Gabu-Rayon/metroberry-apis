<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Trip;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function customerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('customer-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
    }


    public function customerUpdateProfile(Request $request, $id)
    {
        try {
            // Validate the request data
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'phone' => 'required|string|max:15',
                'address' => 'nullable|string|max:255',
                'organisation_id' => 'required|exists:organisations,id',
                'customer_organisation_code' => 'nullable|string|max:255',
            ]);

            // Find the user by ID
            $user = User::findOrFail($id);

            // Update the user's profile
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

            // Find or create the customer's profile
            $customer = Customer::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'organisation_id' => $data['organisation_id'],
                    'customer_organisation_code' => $data['customer_organisation_code'],
                ]
            );

            return response()->json([
                'message' => 'Profile updated successfully',
                'user' => $user,
                'customer' => $customer
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR UPDATING CUSTOMER PROFILE');
            Log::error($e);

            return response()->json([
                'message' => 'Error occurred while updating profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /***
     * Reset Password Methods
     */


    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)]);
        } else {
            return response()->json(['message' => __($status)], 400);
        }
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)]);
        } else {
            return response()->json(['message' => __($status)], 400);
        }
    }

    /***
     * Update Customer Avatar
     * 
     */

    public function customerUpdateProfileAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('avatars', $avatarName, 'public');

            // Delete the old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Update the user's avatar path
            $user->avatar = $avatarPath;
            $user->save();

            return response()->json(['message' => 'Avatar updated successfully', 'avatar' => $avatarPath], 200);
        }

        return response()->json(['error' => 'No avatar uploaded'], 400);
    }

    /***
     *Customer A Book A trip 
     */
    public function bookTrip(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_location' => 'required|string',
            'end_location' => 'required|string',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $trip = Trip::create([
            'customer_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'start_location' => $request->start_location,
            'end_location' => $request->end_location,
            'start_time' => $request->start_time,
            'status' => 'booked',
        ]);

        return response()->json(['message' => 'Trip booked successfully', 'trip' => $trip], 201);
    }
    /**
     * Customer Cancel A trip 
     * 
     */
    public function cancelTrip(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
        ]);

        $trip = Trip::where('id', $request->trip_id)->where('customer_id', Auth::id())->first();

        if (!$trip) {
            return response()->json(['message' => 'Trip not found or not authorized to cancel'], 404);
        }

        $trip->status = 'canceled';
        $trip->save();

        return response()->json(['message' => 'Trip canceled successfully'], 200);
    }
    /***
     * Customer Update Booked Trip
     */

    public function updateBookedTrip(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_location' => 'required|string',
            'end_location' => 'required|string',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $trip = Trip::where('id', $request->trip_id)->where('customer_id', Auth::id())->first();

        if (!$trip) {
            return response()->json(['message' => 'Trip not found or not authorized to update'], 404);
        }

        $trip->vehicle_id = $request->vehicle_id;
        $trip->driver_id = $request->driver_id;
        $trip->start_location = $request->start_location;
        $trip->end_location = $request->end_location;
        $trip->start_time = $request->start_time;
        $trip->save();

        return response()->json(['message' => 'Trip updated successfully', 'trip' => $trip], 200);
    }



    /*****
     * Email Verification Process
     */

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'verification_token' => 'required|string'
        ]);

        $user = User::where('verification_token', $request->verification_token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid verification token'], 400);
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->email_status = true;
        $user->save();

        return response()->json(['message' => 'Email verified successfully'], 200);
    }

    public function resendEmailVerification(Request $request)
    {
        $user = Auth::user();

        if ($user->email_status) {
            return response()->json(['message' => 'Email already verified'], 400);
        }

        $user->verification_token = Str::random(60);
        $user->save();

        // Send email verification link
        Mail::send('emails.verify', ['token' => $user->verification_token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Email Verification');
        });

        return response()->json(['message' => 'Verification email resent'], 200);
    }

    /****
     * phone Verification
     */


    public function verifyPhone(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string'
        ]);

        $user = Auth::user();

        if ($user->phone_verification_code !== $request->verification_code) {
            return response()->json(['message' => 'Invalid verification code'], 400);
        }

        $user->phone_verified_at = now();
        $user->phone_verification_code = null;
        $user->phone_status = true;
        $user->save();

        return response()->json(['message' => 'Phone verified successfully'], 200);
    }

    public function resendPhoneVerification(Request $request)
    {
        $user = Auth::user();

        if ($user->phone_status) {
            return response()->json(['message' => 'Phone already verified'], 400);
        }

        $user->phone_verification_code = Str::random(6);
        $user->save();

        // Send phone verification code via SMS
        Log::info("Sending phone verification code {$user->phone_verification_code} to phone number {$user->phone}");

        // Assume an SMS sending service is integrated here.

        return response()->json(['message' => 'Verification code resent'], 200);
    }
}