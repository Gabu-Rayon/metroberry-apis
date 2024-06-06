<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Organisation;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $user = User::find(Auth::id());
            if ($user->hasRole('admin')) {
                $drivers = Driver::all();
            } else {
                $drivers = Driver::where('organisation_id', $user->organization_id)->get();
            }

            return response()->json([
                'drivers' => $drivers
            ], 200);
        } catch (\Exception $e) {
            Log::error('VIEW DRIVERS ERROR');
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
        try {

                $creator = Organisation::find(Auth::id());

                Log::info('CREATOR');
                Log::info($creator);

                $data = $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'phone' => 'required|string',
                    'password' => 'required|string',
                ]);
    
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => bcrypt($data['password']),
                ]);
    
                $user->assignRole('driver');
    
                $driver = Driver::create([
                    'user_id' => $user->id,
                    'organisation_id' => $creator? $creator->id : $request->organisation_id,
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
    public function show(Driver $driver) {
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
    public function update(Request $request, Driver $driver) {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $driver->user_id,
                'phone' => 'required|string',
            ]);

            $driver->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);

            return response()->json([
                'message' => 'Driver updated successfully',
                'driver' => $driver
            ], 200);
        } catch (Exception $e) {
            Log::error('UPDATE DRIVER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver) {
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
