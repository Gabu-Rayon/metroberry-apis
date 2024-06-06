<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Organisation;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Organisation;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $vehicles = Vehicle::where('organisation_id', auth()->user()->organisation->id)->get();
            return response()->json([
                'vehicles' => $vehicles
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING VEHICLES');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while fetching vehicles',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
<<<<<<< HEAD
    // public function store(Request $request) {
    //     try {


    //         $creator = Organisation::find(Auth::id());

    //         Log::info('CREATOR');
    //         Log::info($creator);

    //         $data = $request->validate([
    //             'make' => 'required|string',
    //             'model' => 'required|string',
    //             'year' => 'required|integer',
    //             'color' => 'required|string',
    //             'plate_number' => 'required|string',
    //             'seats' => 'required|integer',
    //             'fuel_type' => 'required|string',
    //             'engine_size' => 'required|string',
    //         ]);

    //         Log::info('VEHICLE VALIDATION DATA');
    //         Log::info($data);

    //         $vehicle = Vehicle::create([
    //             'make' => $data['make'],
    //             'model' => $data['model'],
    //             'year' => $data['year'],
    //             'color' => $data['color'],
    //             'plate_number' => $data['plate_number'],
    //             'seats' => $data['seats'],
    //             'fuel_type' => $data['fuel_type'],
    //             'engine_size' => $data['engine_size'],
    //             'created_by' => Auth::id(),
    //             'status' => 'inactive'
    //         ]);

    //         return response()->json([
    //             'message' => 'Vehicle created successfully',
    //             'vehicle' => $vehicle
    //         ], 201);
    //     } catch (Exception $e) {
    //         Log::error('ERROR CREATING VEHICLE');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'Error occurred while creating vehicle',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
    {
        try {
            $creator = Organisation::find(Auth::id());

            Log::info('User with role of Admin / Organisation Creating Driver');
            Log::info($creator);
=======
    public function store (Request $request) {

        try {
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();

            Log::info('ORGANISATION');
            Log::info($organisation);

            if (!$organisation) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }
>>>>>>> 06514025425cda377e1adccff2d0d41f456ff5a6

            $data = $request->validate([
                'make' => 'required|string',
                'model' => 'required|string',
                'year' => 'required|integer',
                'color' => 'required|string',
                'plate_number' => 'required|string',
                'seats' => 'required|integer',
                'fuel_type' => 'required|string',
                'engine_size' => 'required|string',
            ]);

            Log::info('VEHICLE VALIDATION DATA');
            Log::info($data);

            DB::beginTransaction();

            $vehicle = Vehicle::create([
                'organisation_id' => $organisation->id,
                'make' => $data['make'],
                'model' => $data['model'],
                'year' => $data['year'],
                'color' => $data['color'],
                'plate_number' => $data['plate_number'],
                'seats' => $data['seats'],
                'fuel_type' => $data['fuel_type'],
                'engine_size' => $data['engine_size'],
                'created_by' => Auth::id(),
                'status' => 'inactive'
            ]);

            Log::info('VEHICLE');
            Log::info($vehicle);

            DB::commit();

            return response()->json([
                'message' => 'Vehicle created successfully',
                'vehicle' => $vehicle
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ERROR CREATING VEHICLE');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while creating vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id, Request $request) {
        try {
            $user = $request->user();
            $driver = $user->driver;

            Log::info('DRIVER INFO');
            Log::info($driver);

            $vehicle = $driver->vehicle;

            Log::info('DRIVER VEHICLE INFO');
            Log::info($vehicle);

            if (!$vehicle) {
                return response()->json([
                    'error' => 'Driver has no vehicle'
                ], 404);
            }

            return response()->json([
                'vehicle' => $vehicle
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING VEHICLE');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while fetching vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        try {
            $vehicle = Vehicle::find($id);
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();

            if (!$vehicle) {
                return response()->json([
                    'message' => 'Vehicle not found',
                ], 404);
            }

            if (!$organisation || $vehicle->organisation_id !== $organisation->id) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            $data = $request->validate([
                'make' => 'required|string',
                'model' => 'required|string',
                'year' => 'required|integer',
                'color' => 'required|string',
                'plate_number' => 'required|string',
                'seats' => 'required|integer',
                'fuel_type' => 'required|string',
                'engine_size' => 'required|string',
            ]);

            $vehicle->make = $data['make'];
            $vehicle->model = $data['model'];
            $vehicle->year = $data['year'];
            $vehicle->color = $data['color'];
            $vehicle->plate_number = $data['plate_number'];
            $vehicle->seats = $data['seats'];
            $vehicle->fuel_type = $data['fuel_type'];
            $vehicle->engine_size = $data['engine_size'];

            $vehicle->save();

            return response()->json([
                'message' => 'Vehicle updated successfully',
                'vehicle' => $vehicle
            ], 200);

        } catch (Exception $e) {
            Log::error('ERROR UPDATING VEHICLE');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while updating vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            $vehicle = Vehicle::find($id);
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();


            if (!$vehicle) {
                return response()->json([
                    'error' => 'Vehicle not found'
                ], 404);
            }

            if (!$organisation || $vehicle->organisation_id !== $organisation->id) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            $vehicle->delete();

            return response()->json([
                'message' => 'Vehicle deleted successfully'
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR DELETING VEHICLE');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while deleting vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Assign driver to vehicle
     */

    public function assign_driver($vehicle, Request $request) {
        try {

            $car = Vehicle::find($vehicle);
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();

            $data = $request->validate([
                'driver_id' => 'required|integer'
            ]);

            if (!$car) {
                return response()->json([
                    'error' => 'Vehicle not found'
                ], 404);
            }

            if ($car->status === 'active') {
                return response()->json([
                    'error' => 'Vehicle already has a driver'
                ], 400);
            }

            if (!$organisation) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            if ($car->organisation_id !== $organisation->id) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            $driver = Driver::find($data['driver_id']);

            if (!$driver) {
                return response()->json([
                    'error' => 'Driver not found'
                ], 404);
            }

            if ($driver->vehicle) {
                return response()->json([
                    'error' => 'Driver already has a vehicle'
                ], 400);
            }

            if (!$driver->license) {
                return response()->json([
                    'error' => 'Driver has no license'
                ], 400);
            }

            if (!$driver->license_expiry || strtotime($driver->license_expiry) < time()) {
                return response()->json([
                    'error' => 'Driver license has expired'
                ], 400);
            }

            $car->driver_id = $driver->id;
            $car->status = 'active';
            $car->save();

            return response()->json([
                'message' => 'Driver assigned to vehicle successfully',
                'vehicle' => $car
            ], 200);

        } catch (Exception $e) {
            Log::error('ERROR ASSIGNING DRIVER TO VEHICLE');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while assigning driver to vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}