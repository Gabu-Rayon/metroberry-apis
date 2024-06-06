<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


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
            'destination' => 'required|string',
            'pickup_location' => 'required|string',
            'trip_date' => 'required|date',
            'trip_time' => 'required|string',
        ]);

        $user = Auth::user();

        $trip = Trip::create([
            'customer_id' => $user->customer->id,
            'destination' => $request->destination,
            'pickup_location' => $request->pickup_location,
            'trip_date' => $request->trip_date,
            'trip_time' => $request->trip_time,
            'status' => 'booked',
        ]);

        return response()->json([
            'message' => 'Trip booked successfully',
            'trip' => $trip
        ], 201);
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

        $trip = Trip::where('id', $request->trip_id)
            ->where('customer_id', Auth::user()->customer->id)
            ->first();

        if (!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }

        $trip->update(['status' => 'canceled']);

        return response()->json(['message' => 'Trip canceled successfully'], 200);
    }
    /***
     * 
     */

    public function updateBookedTrip(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'destination' => 'sometimes|string',
            'pickup_location' => 'sometimes|string',
            'trip_date' => 'sometimes|date',
            'trip_time' => 'sometimes|string',
        ]);

        $trip = Trip::where('id', $request->trip_id)
            ->where('customer_id', Auth::user()->customer->id)
            ->first();

        if (!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }

        $trip->update($request->only('destination', 'pickup_location', 'trip_date', 'trip_time'));

        return response()->json(['message' => 'Trip updated successfully', 'trip' => $trip], 200);
    }


}