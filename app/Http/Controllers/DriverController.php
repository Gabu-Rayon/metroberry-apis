<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            if ($user->role == 'admin') {
                $drivers = Driver::with('vehicle')->get();
            } else {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }
            return response()->json([
                'drivers' => $drivers
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching drivers');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $creator = User::find(Auth::id());

            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'phone' => 'required|string',
                'address' => 'nullable|string',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'national_id_no' => 'required|string|unique:drivers',
                'date_of_birth' => 'required|date_format:Ymd',
                'sex' => 'required|string|in:Male,Female',
                'national_id_avatar_front' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'national_id_avatar_back' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'driving_license_no' => 'required|string|unique:drivers',
                'driving_license_date_of_issue' => 'required|date_format:Ymd',
                'driving_license_date_of_expiry' => 'required|date_format:Ymd',
                'driving_license_avatar_front' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'driving_license_avatar_back' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'psv_badge_no' => 'required|string|unique:drivers',
                'psv_badge_date_of_issue' => 'required|date_format:Ymd',
                'psv_badge_date_of_expiry' => 'required|date_format:Ymd',
                'psv_badge_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'kra_pin_certificate_no' => 'required|string|unique:drivers',
                'kra_pin_certificate_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'certificate_of_good_conduct_no' => 'required|string|unique:drivers',
                'certificate_of_good_conduct_issue_date' => 'required|date_format:Ymd',
                'certificate_of_good_conduct_expiry_date' => 'required|date_format:Ymd',
                'certificate_of_good_conduct_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $avatarPath = null;
            $nationalIdFrontPath = null;
            $nationalIdBackPath = null;
            $dlFrontPath = null;
            $dlBackPath = null;
            $psvBadgePath = null;
            $kraPinPath = null;
            $certificateOfGoodConductPath = null;

            $username = str_replace(' ', '-', $data['name']);

            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                $extension = $avatarFile->getClientOriginalExtension();
                $avatarFileName = $username . '-driverAvatar.' . $extension;
                $storedPath = $avatarFile->storeAs('public/DriversAvatars', $avatarFileName);
                $avatarPath = str_replace('public/', '', $storedPath);
            }

            if ($request->hasFile('national_id_avatar_front')) {
                $nationalIdFrontFile = $request->file('national_id_avatar_front');
                $extension = $nationalIdFrontFile->getClientOriginalExtension();
                $nationalIdFrontFileName = $username . '-nationalIdFront.' . $extension;
                $storedPath = $nationalIdFrontFile->storeAs('public/DriversNationalIdAvatars', $nationalIdFrontFileName);
                $nationalIdFrontPath = str_replace('public/', '', $storedPath);
            }

            if ($request->hasFile('national_id_avatar_back')) {
                $nationalIdBackFile = $request->file('national_id_avatar_back');
                $extension = $nationalIdBackFile->getClientOriginalExtension();
                $nationalIdBackFileName = $username . '-nationalIdBack.' . $extension;
                $storedPath = $nationalIdBackFile->storeAs('public/DriversNationalIdAvatars', $nationalIdBackFileName);
                $nationalIdBackPath = str_replace('public/', '', $storedPath);
            }

            if ($request->hasFile('driving_license_avatar_front')) {
                $dlFrontFile = $request->file('driving_license_avatar_front');
                $extension = $dlFrontFile->getClientOriginalExtension();
                $dlFrontFileName = $username . '-dlFront.' . $extension;
                $storedPath = $dlFrontFile->storeAs('public/DriversDLAvatars', $dlFrontFileName);
                $dlFrontPath = str_replace('public/', '', $storedPath);
            }

            if ($request->hasFile('driving_license_avatar_back')) {
                $dlBackFile = $request->file('driving_license_avatar_back');
                $extension = $dlBackFile->getClientOriginalExtension();
                $dlBackFileName = $username . '-dlBack.' . $extension;
                $storedPath = $dlBackFile->storeAs('public/DriversDLAvatars', $dlBackFileName);
                $dlBackPath = str_replace('public/', '', $storedPath);
            }

            if ($request->hasFile('psv_badge_avatar')) {
                $psvBadgeFile = $request->file('psv_badge_avatar');
                $extension = $psvBadgeFile->getClientOriginalExtension();
                $psvBadgeFileName = $username . '-psvBadge.' . $extension;
                $storedPath = $psvBadgeFile->storeAs('public/DriversPSVAvatars', $psvBadgeFileName);
                $psvBadgePath = str_replace('public/', '', $storedPath);
            }

            if ($request->hasFile('kra_pin_certificate_avatar')) {
                $kraPinFile = $request->file('kra_pin_certificate_avatar');
                $extension = $kraPinFile->getClientOriginalExtension();
                $kraPinFileName = $username . '-kraPin.' . $extension;
                $storedPath = $kraPinFile->storeAs('public/DriversKRAAvatars', $kraPinFileName);
                $kraPinPath = str_replace('public/', '', $storedPath);
            }

            if ($request->hasFile('certificate_of_good_conduct_avatar')) {
                $certificateOfGoodConductFile = $request->file('certificate_of_good_conduct_avatar');
                $extension = $certificateOfGoodConductFile->getClientOriginalExtension();
                $certificateOfGoodConductFileName = $username . '-certificateOfGoodConduct.' . $extension;
                $storedPath = $certificateOfGoodConductFile->storeAs('public/DriversCertificateOfGoodConductAvatars', $certificateOfGoodConductFileName);
                $certificateOfGoodConductPath = str_replace('public/', '', $storedPath);
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'phone' => $data['phone'],
                'address' => $data['address'],
                'avatar' => $avatarPath,
                'role' => 'driver',
                'created_by' => Auth::id()
            ]);

            $driver = Driver::create([
                'user_id' => $user->id,
                'organisation_id' => null,
                'vehicle_id' => null,
                'created_by' => Auth::id(),
                'national_id_no' => $data['national_id_no'],
                'date_of_birth' => $data['date_of_birth'],
                'sex' => $data['sex'],
                'national_id_avatar_front' => $nationalIdFrontPath,
                'national_id_avatar_back' => $nationalIdBackPath,
                'driving_license_no' => $data['driving_license_no'],
                'driving_license_date_of_issue' => $data['driving_license_date_of_issue'],
                'driving_license_date_of_expiry' => $data['driving_license_date_of_expiry'],
                'driving_license_avatar_front' => $dlFrontPath,
                'driving_license_avatar_back' => $dlBackPath,
                'psv_badge_no' => $data['psv_badge_no'],
                'psv_badge_date_of_issue' => $data['psv_badge_date_of_issue'],
                'psv_badge_date_of_expiry' => $data['psv_badge_date_of_expiry'],
                'psv_badge_avatar' => $psvBadgePath,
                'kra_pin_certificate_no' => $data['kra_pin_certificate_no'],
                'kra_pin_certificate_avatar' => $kraPinPath,
                'certificate_of_good_conduct_no' => $data['certificate_of_good_conduct_no'],
                'certificate_of_good_conduct_issue_date' => $data['certificate_of_good_conduct_issue_date'],
                'certificate_of_good_conduct_expiry_date' => $data['certificate_of_good_conduct_expiry_date'],
                'certificate_of_good_conduct_avatar' => $certificateOfGoodConductPath,
                'status' => 'inactive'
            ]);

            DB::commit();
            
            return response()->json([
                'message' => 'Driver created successfully',
                'driver' => $driver
            ], 201);

            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('CREATE DRIVER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $driver = Driver::with('vehicle')->findOrFail($id);
    
            return response()->json([
                'driver' => $driver
            ], 200);
        } catch (Exception $e) {
            Log::error('Error fetching driver');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Driver $driver)
    {
        try {
            $creator = User::find(Auth::id());

            Log::info('Creator Updating the Driver Details :');
            Log::info($creator);

            // Log request data for debugging
            Log::info('Request Data:', $request->all());

            // Validate the request data
            $data = $request->validate([
                'name' => 'nullable|string',
                'email' => 'nullable|email|unique:users,email,' . $driver->user_id,
                'phone' => 'nullable|string',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

                'national_id_no' => 'nullable|string|unique:drivers,national_id_no,' . $driver->id,
                'national_id_avatar_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'national_id_avatar_behind' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

                'sex' => 'nullable|string',
                'date_of_birth' => 'nullable|date_format:Y-m-d',

                'driving_license_no' => 'nullable|string|unique:drivers,driving_license_no,' . $driver->id,
                'driving_license_date_issued' => 'nullable|date_format:Y-m-d',
                'driving_license_date_expiry' => 'nullable|date_format:Y-m-d',

                'dl_county_of_residence' => 'nullable|string',
                'dl_avatar_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'dl_avatar_behind' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = $driver->user;

            if ($request->hasFile('avatar') && $user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $request->hasFile('avatar') ? $request->file('avatar')->store('DriversAvatars', 'public') : $user->avatar;

            $user->update([
                'name' => $data['name'] ?? $user->name,
                'email' => $data['email'] ?? $user->email,
                'phone' => $data['phone'] ?? $user->phone,
                'avatar' => $user->avatar,
            ]);

            // Handle national ID avatars
            if ($request->hasFile('national_id_avatar_front') && $driver->national_id_avatar_front) {
                Storage::disk('public')->delete($driver->national_id_avatar_front);
            }

            $driver->national_id_avatar_front = $request->hasFile('national_id_avatar_front') ? $request->file('national_id_avatar_front')->store('DriversNationalIdAvatars', 'public') : $driver->national_id_avatar_front;

            if ($request->hasFile('national_id_avatar_behind') && $driver->national_id_avatar_behind) {
                Storage::disk('public')->delete($driver->national_id_avatar_behind);
            }

            $driver->national_id_avatar_behind = $request->hasFile('national_id_avatar_behind') ? $request->file('national_id_avatar_behind')->store('DriversNationalIdAvatars', 'public') : $driver->national_id_avatar_behind;

            // Handle driving license avatars
            if ($request->hasFile('dl_avatar_front') && $driver->dl_avatar_front) {
                Storage::disk('public')->delete($driver->dl_avatar_front);
            }

            $driver->dl_avatar_front = $request->hasFile('dl_avatar_front') ? $request->file('dl_avatar_front')->store('DriversDLAvatars', 'public') : $driver->dl_avatar_front;

            if ($request->hasFile('dl_avatar_behind') && $driver->dl_avatar_behind) {
                Storage::disk('public')->delete($driver->dl_avatar_behind);
            }

            $driver->dl_avatar_behind = $request->hasFile('dl_avatar_behind') ? $request->file('dl_avatar_behind')->store('DriversDLAvatars', 'public') : $driver->dl_avatar_behind;

            // Update driver data
            $driverData = [
                'national_id_no' => $data['national_id_no'] ?? $driver->national_id_no,
                'national_id_avatar_front' => $driver->national_id_avatar_front,
                'national_id_avatar_behind' => $driver->national_id_avatar_behind,
                'sex' => $data['sex'] ?? $driver->sex,
                'date_of_birth' => $data['date_of_birth'] ?? $driver->date_of_birth,
                'driving_license_no' => $data['driving_license_no'] ?? $driver->driving_license_no,
                'driving_license_date_issued' => $data['driving_license_date_issued'] ?? $driver->driving_license_date_issued,
                'driving_license_date_expiry' => $data['driving_license_date_expiry'] ?? $driver->driving_license_date_expiry,
                'dl_county_of_residence' => $data['dl_county_of_residence'] ?? $driver->dl_county_of_residence,
                'dl_avatar_front' => $driver->dl_avatar_front,
                'dl_avatar_behind' => $driver->dl_avatar_behind,
            ];

            // Filter out null values from driver data before updating
            $driverData = array_filter($driverData, function ($value) {
                return !is_null($value);
            });

            $driver->update($driverData);

            return response()->json([
                'message' => 'Driver updated successfully',
                'driver' => $driver->load('user')
            ], 200);
        } catch (ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            Log::error('UPDATE DRIVER ERROR: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     */
    public function destroy(Driver $driver)
    {
        try {
            // Delete associated user
            $driver->user->delete();

            // Delete driver record
            $driver->delete();

            return response()->json([
                'message' => 'Driver deleted successfully'
            ], 200);
        } catch (Exception $e) {
            Log::error('DELETE DRIVER ERROR: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function renewLicense (Request $request, $driver_id) {
        DB::beginTransaction();

        try {
            $driver = Driver::findOrFail($driver_id);


            $request->validate([
                'startDate' => 'required|date_format:Y-m-d',
                'endDate' => 'required|date_format:Y-m-d',
            ]);

            $driver->driving_license_date_issued = $request->startDate;
            $driver->driving_license_date_expiry = $request->endDate;
            $driver->save();

            DB::commit();

            return response()->json([
                'message' => 'License renewed successfully',
                'driver' => $driver
            ], 200);

            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('RENEW LICENSE ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function activateDriver($driver_id) {
        DB::beginTransaction();
        try {
            $driver = Driver::findOrFail($driver_id);

            $driver->status = 'active';
            $driver->save();

            DB::commit();

            return response()->json([
                'message' => 'Driver activated successfully',
                'driver' => $driver
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ACTIVATE DRIVER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deactivateDriver($driver_id) {
        DB::beginTransaction();
        try {
            $driver = Driver::findOrFail($driver_id);

            $driver->status = 'inactive';
            $driver->save();

            DB::commit();

            return response()->json([
                'message' => 'Driver deactivated successfully',
                'driver' => $driver
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('DEACTIVATE DRIVER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}