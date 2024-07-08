<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Driver;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // try {
        //     $user = User::find(Auth::id());
        //     if ($user->hasRole('admin')) {
        //         $drivers = Driver::all();
        //     } else {
        //         $drivers = Driver::where('user_id', $user->user_id)->get();
        //     }

        //     return response()->json([
        //         'drivers' => $drivers
        //     ], 200);
        // } catch (Exception $e) {
        //     Log::error('VIEW Organisation ERROR');
        //     Log::error($e);
        //     return response()->json([
        //         'message' => 'An error occurred',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }

        $drivers = Driver::with('user')->get();
        return view('driver', compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     try {

    //         $creator = Organisation::find(Auth::id());

    //         Log::info('CREATOR');
    //         Log::info($creator);

    //         $data = $request->validate([
    //             'name' => 'required|string',
    //             'email' => 'required|email|unique:users,email',
    //             'phone' => 'required|string',
    //             'password' => 'required|string',
    //         ]);

    //         $user = User::create([
    //             'name' => $data['name'],
    //             'email' => $data['email'],
    //             'phone' => $data['phone'],
    //             'password' => bcrypt($data['password']),
    //             // next we will add avatar when creating Driver 
    //         ]);

    //         $driver = Driver::create([
    //             'user_id' => $user->id,
    //             'organisation_id' => $creator->id ?? null,
    //             'created_by' => Auth::id(),
    //             'status' => 'inactive'
    //         ]);
    //         return response()->json([
    //             'message' => 'Driver created successfully !',
    //             'driver' => $driver
    //         ], 201);
    //     } catch (Exception $e) {
    //         Log::error('CREATE DRIVER ERROR');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'An error occurred',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
    {
        try {
            $creator = User::find(Auth::id());

            Log::info('CREATOR');
            Log::info($creator);

            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string',
                'password' => 'required|integer',
                'organisation_id' => 'required|string',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'national_id_no' => 'required|string|unique:drivers',
                'national_id_avatar_front' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'national_id_avatar_behind' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'sex' => 'required|string',
                'date_of_birth' => 'required|date_format:Y-m-d',
                'driving_license_no' => 'required|string|unique:drivers',
                'driving_license_date_issued' => 'required|date_format:Y-m-d',
                'driving_license_date_expiry' => 'required|date_format:Y-m-d',
                'dl_county_of_residence' => 'required|string',
                'dl_avatar_front' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'dl_avatar_behind' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('DriversAvatars', 'public');
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'avatar' => $avatarPath,
            ]);

            $driver = Driver::create([
                'user_id' => $user->id,
                'organisation_id' => $data['organisation_id'],
                'created_by' => Auth::id(),
                'status' => 'inactive',
                'national_id_no' => $data['national_id_no'],
                'national_id_avatar_front' => $request->file('national_id_avatar_front')->store('DriversIDAvatars', 'public'),
                'national_id_avatar_behind' => $request->file('national_id_avatar_behind')->store('DriversIDAvatars', 'public'),
                'sex' => $data['sex'],
                'date_of_birth' => $data['date_of_birth'],
                'driving_license_no' => $data['driving_license_no'],
                'driving_license_date_issued' => $data['driving_license_date_issued'],
                'driving_license_date_expiry' => $data['driving_license_date_expiry'],
                'dl_county_of_residence' => $data['dl_county_of_residence'],
                'dl_avatar_front' => $request->file('dl_avatar_front')->store('DriversLicenseAvatars', 'public'),
                'dl_avatar_behind' => $request->file('dl_avatar_behind')->store('DriversLicenseAvatars', 'public'),
            ]);

            return response()->json([
                'message' => 'Driver created successfully',
                'driver' => $driver
            ], 201);
        } catch (Exception $e) {
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
    public function show(Driver $driver)
    {
        try {
            return response()->json([
                'driver' => $driver
            ], 200);
        } catch (Exception $e) {
            Log::error('SHOW DRIVER ERROR');
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
    // public function update(Request $request, Driver $driver)
    // {
    //     try {
    //         $data = $request->validate([
    //             'name' => 'required|string',
    //             'email' => 'required|email|unique:users,email,' . $driver->user_id,
    //             'phone' => 'required|string',
    //         ]);

    //         $driver->user->update([
    //             'name' => $data['name'],
    //             'email' => $data['email'],
    //             'phone' => $data['phone'],
    //         ]);

    //         return response()->json([
    //             'message' => 'Driver updated successfully',
    //             'driver' => $driver
    //         ], 200);
    //     } catch (Exception $e) {
    //         Log::error('UPDATE DRIVER ERROR');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'An error occurred',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function create(){
        return view('driver.create');
    }


    public function edit(){
        return view('driver.edit');
    }

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
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $driver->user_id,
                'phone' => 'required|string',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = $driver->user;
            $avatarPath = $user->avatar;

            if ($request->hasFile('avatar')) {
                // Delete the old avatar if it exists
                if ($avatarPath) {
                    Storage::disk('public')->delete($avatarPath);
                }

                // Store the new avatar in the public/DriversAvatars directory
                $avatarPath = $request->file('avatar')->store('DriversAvatars', 'public');
            }

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'avatar' => $avatarPath,
            ]);

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
     */
    public function destroy(Driver $driver)
    {
        try {
            $driver->user->delete();
            $driver->delete();

            return response()->json([
                'message' => 'Driver deleted successfully'
            ], 200);
        } catch (Exception $e) {
            Log::error('DELETE DRIVER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}