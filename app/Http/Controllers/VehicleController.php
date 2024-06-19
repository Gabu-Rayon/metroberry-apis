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
use Illuminate\Support\Facades\Gate;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Retrieve all vehicles with related creator and driver details
            $vehicles = Vehicle::with([
                'creator:id,name,email',
                'driver.user:id,name,email'
            ])->get();

            Log::info('All Vehicles from the API:', $vehicles->toArray());

            $response = $vehicles->map(function ($vehicle) {
                return [
                    'id' => $vehicle->id,
                    'make' => $vehicle->make,
                    'model' => $vehicle->model,
                    'year' => $vehicle->year,
                    'color' => $vehicle->color,
                    'plate_number' => $vehicle->plate_number,
                    'seats' => $vehicle->seats,
                    'fuel_type' => $vehicle->fuel_type,
                    'engine_size' => $vehicle->engine_size,
                    'organisation_id' => $vehicle->engine_size,
                    'vehicle_insurance_issue_date' => $vehicle->vehicle_insurance_issue_date,
                    'vehicle_insurance_expiry' => $vehicle->vehicle_insurance_expiry,
                    'vehicle_insurance_issue_organisation' => $vehicle->vehicle_insurance_issue_organisation,
                    'vehicle_avatar' => $vehicle->vehicle_avatar,
                    'status' => 'inactive',
                    'creator' => [
                        'id' => $vehicle->creator->id,
                        'name' => $vehicle->creator->name,
                        'email' => $vehicle->creator->email,
                        'address' => $vehicle->creator->address,
                    ],
                    'driver' => $vehicle->driver ? [
                        'id' => $vehicle->driver->user->id,
                        'name' => $vehicle->driver->user->name,
                        'email' => $vehicle->driver->user->email,
                        'address' => $vehicle->driver->user->address,
                    ] : null,
                ];
            });

            return response()->json([
                'vehicles' => $response
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
    public function store(Request $request)
    {
        try {
            $userId = Auth::id();
            if (!$userId) {
                Log::error('User not authenticated');
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            Log::info('Authenticated User ID: ' . $userId);

            $creator = Organisation::find($userId);
            Log::info('CREATOR', ['creator' => $creator]);

            $data = $request->validate([
                'make' => 'required|string',
                'model' => 'required|string',
                'year' => 'required|integer',
                'color' => 'required|string',
                'plate_number' => 'required|string',
                'seats' => 'required|integer',
                'fuel_type' => 'required|string',
                'engine_size' => 'required|string',
                'organisation_id' => 'required|integer',
                'vehicle_insurance_issue_date' => 'nullable|date_format:Y-m-d',
                'vehicle_insurance_expiry' => 'nullable|date_format:Y-m-d',
                'vehicle_insurance_issue_organisation' => 'nullable|string',
                'vehicle_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('VEHICLE VALIDATION DATA', ['data' => $data]);

            $avatarPath = null;
            if ($request->hasFile('vehicle_avatar')) {
                $avatarPath = $request->file('vehicle_avatar')->store('VehicleAvatars', 'public');
                Log::info('Avatar Path: ' . $avatarPath);
            }

            $vehicle = Vehicle::create([
                'make' => $data['make'],
                'model' => $data['model'],
                'year' => $data['year'],
                'color' => $data['color'],
                'plate_number' => $data['plate_number'],
                'seats' => $data['seats'],
                'fuel_type' => $data['fuel_type'],
                'engine_size' => $data['engine_size'],
                'organisation_id' => $data['organisation_id'],
                'vehicle_insurance_issue_date' => $data['vehicle_insurance_issue_date'],
                'vehicle_insurance_expiry' => $data['vehicle_insurance_expiry'],
                'vehicle_insurance_issue_organisation' => $data['vehicle_insurance_issue_organisation'],
                'vehicle_avatar' => $avatarPath,
                'created_by' => $userId,
                'status' => 'inactive'
            ]);

            Log::info('VEHICLE CREATED', ['vehicle' => $vehicle]);

            return response()->json([
                'message' => 'Vehicle created successfully',
                'vehicle' => $vehicle
            ], 201);
        } catch (Exception $e) {
            Log::error('ERROR CREATING VEHICLE', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Error occurred while creating vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // public function store(Request $request)
    // {
    //     try {
    //         $creator = Organisation::find(Auth::id());

    //         Log::info('User with role of Admin / Organisation Creating Vechile');
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

    //         DB::beginTransaction();

    //         $organisation = Organisation::find(Auth::id());

    //         Log::info('Who is creating the Vehicle : ' . $organisation);

    //         $vehicle = Vehicle::create([
    //             'organisation_id' => $organisation->id,
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

    //         Log::info('VEHICLE');
    //         Log::info($vehicle);

    //         DB::commit();

    //         return response()->json([
    //             'message' => 'Vehicle created successfully',
    //             'vehicle' => $vehicle
    //         ], 201);

    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error('ERROR CREATING VEHICLE');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'Error occurred while creating vehicle',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    /**
     * Display the specified resource.
     */
    public function show($vehicleId, Request $request)
    {
        try {
            // Retrieve the vehicle with related creator and driver details
            $vehicle = Vehicle::with([
                'creator:id,name,email',
                'driver.user:id,name,email'
            ])->findOrFail($vehicleId);

            Log::info('Vehicle details from the API:', $vehicle->toArray());

            $response = [
                'id' => $vehicle->id,
                'make' => $vehicle->make,
                'model' => $vehicle->model,
                'year' => $vehicle->year,
                'color' => $vehicle->color,
                'plate_number' => $vehicle->plate_number,
                'seats' => $vehicle->seats,
                'fuel_type' => $vehicle->fuel_type,
                'engine_size' => $vehicle->engine_size,
                'organisation_id' => $vehicle->engine_size,
                'vehicle_insurance_issue_date' => $vehicle->vehicle_insurance_issue_date,
                'vehicle_insurance_expiry' => $vehicle->vehicle_insurance_expiry,
                'vehicle_insurance_issue_organisation' => $vehicle->vehicle_insurance_issue_organisation,
                'vehicle_avatar' => $vehicle->vehicle_avatar,
                'status' => 'inactive',
                'creator' => [
                    'id' => $vehicle->creator->id,
                    'name' => $vehicle->creator->name,
                    'email' => $vehicle->creator->email,
                    'address' => $vehicle->creator->address,
                ],
                'driver' => $vehicle->driver ? [
                    'id' => $vehicle->driver->user->id,
                    'name' => $vehicle->driver->user->name,
                    'email' => $vehicle->driver->user->email,
                    'address' => $vehicle->driver->user->address,
                ] : null,

                // 'organisation' => $vehicle->driver ? [
                //     'id' => $vehicle->driver->user->id,
                //     'name' => $vehicle->driver->user->name,
                //     'email' => $vehicle->driver->user->email,
                //     'address' => $vehicle->driver->user->address,
                // ] : null,
            ];

            return response()->json([
                'vehicle' => $response
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
    public function update(Request $request, $vehicleId)
    {
        try {
            // Find the vehicle by its ID
            $vehicle = Vehicle::find($vehicleId);

            // Check if the vehicle exists
            if (!$vehicle) {
                return response()->json([
                    'message' => 'Vehicle not found',
                ], 404);
            }

            // Validate the request data
            $data = $request->validate([
                'make' => 'nullable|string',
                'model' => 'nullable|string',
                'year' => 'nullable|integer',
                'color' => 'nullable|string',
                'plate_number' => 'nullable|string',
                'seats' => 'nullable|integer',
                'fuel_type' => 'nullable|string',
                'engine_size' => 'nullable|string',
                'organisation_id' => 'nullable|integer',
                'vehicle_insurance_issue_date' => 'nullable|date_format:Y-m-d',
                'vehicle_insurance_expiry' => 'nullable|date_format:Y-m-d',
                'vehicle_insurance_issue_organisation' => 'nullable|string',
                'vehicle_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update the vehicle attributes if present in the request
            if (isset($data['make']))
                $vehicle->make = $data['make'];
            if (isset($data['model']))
                $vehicle->model = $data['model'];
            if (isset($data['year']))
                $vehicle->year = $data['year'];
            if (isset($data['color']))
                $vehicle->color = $data['color'];
            if (isset($data['plate_number']))
                $vehicle->plate_number = $data['plate_number'];
            if (isset($data['seats']))
                $vehicle->seats = $data['seats'];
            if (isset($data['fuel_type']))
                $vehicle->fuel_type = $data['fuel_type'];
            if (isset($data['engine_size']))
                $vehicle->engine_size = $data['engine_size'];
            if (isset($data['organisation_id']))
                $vehicle->organisation_id = $data['organisation_id'];
            if (isset($data['vehicle_insurance_issue_date']))
                $vehicle->vehicle_insurance_issue_date = $data['vehicle_insurance_issue_date'];
            if (isset($data['vehicle_insurance_expiry']))
                $vehicle->vehicle_insurance_expiry = $data['vehicle_insurance_expiry'];
            if (isset($data['vehicle_insurance_issue_organisation']))
                $vehicle->vehicle_insurance_issue_organisation = $data['vehicle_insurance_issue_organisation'];

            // Handle vehicle avatar update if provided
            if ($request->hasFile('vehicle_avatar')) {
                $avatarPath = $request->file('vehicle_avatar')->store('VehicleAvatars', 'public');
                $vehicle->vehicle_avatar = $avatarPath;
            }

            // Save the updated vehicle
            $vehicle->save();

            // Return success response
            return response()->json([
                'message' => 'Vehicle updated successfully',
                'vehicle' => $vehicle
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Vehicle not found with ID: ' . $vehicleId);
            return response()->json([
                'message' => 'Vehicle not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            Log::error('ERROR UPDATING VEHICLE');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while updating vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function update(Request $request, $vehicle)
    // {
    //     try {
    //         // Log the incoming request data
    //         Log::info('Request data for car being edited:', $request->all());

    //         // Find the vehicle by its ID
    //         $vehicleInstance = Vehicle::find($vehicle);

    //         // Check if the vehicle exists
    //         if (!$vehicleInstance) {
    //             return response()->json([
    //                 'message' => 'Vehicle not found',
    //             ], 404);
    //         }

    //         // Validate the request data
    //         $data = $request->validate([
    //             'make' => 'nullable|string',
    //             'model' => 'nullable|string',
    //             'year' => 'nullable|integer',
    //             'color' => 'nullable|string',
    //             'plate_number' => 'nullable|string',
    //             'seats' => 'nullable|integer',
    //             'fuel_type' => 'nullable|string',
    //             'engine_size' => 'nullable|string',
    //             'organisation_id' => 'nullable|integer',
    //             'vehicle_insurance_issue_date' => 'nullable|date_format:Y-m-d',
    //             'vehicle_insurance_expiry' => 'nullable|date_format:Y-m-d',
    //             'vehicle_insurance_issue_organisation' => 'nullable|string',
    //             'vehicle_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         ]);

    //         // Log the validated data
    //         Log::info('Validated data for updating car:', $data);

    //         // Update the vehicle attributes if present in the request
    //         foreach ($data as $key => $value) {
    //             if (!is_null($value)) {
    //                 $vehicleInstance->$key = $value;
    //             }
    //         }

    //         // Handle vehicle avatar update if provided
    //         if ($request->hasFile('vehicle_avatar')) {
    //             $avatarPath = $request->file('vehicle_avatar')->store('VehicleAvatars', 'public');
    //             $vehicleInstance->vehicle_avatar = $avatarPath;
    //         }

    //         // Save the updated vehicle
    //         $vehicleInstance->save();

    //         // Return success response
    //         return response()->json([
    //             'message' => 'Vehicle updated successfully',
    //             'vehicle' => $vehicleInstance
    //         ], 200);

    //     } catch (Exception $e) {
    //         Log::error('Error occurred while updating vehicle: ' . $e->getMessage());
    //         return response()->json([
    //             'message' => 'Error occurred while updating vehicle',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $vehicle = Vehicle::find($id);

            if (!$vehicle) {
                return response()->json([
                    'error' => 'Vehicle not found'
                ], 404);
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
     * 
     */

    // public function assign_driver($vehicle, Request $request) {
    //     try {

    //         $car = Vehicle::find($vehicle);

    //         Log::info("Vechile being Assign on:" . $car );

    //         $organisation = Organisation::where('user_id', auth()->user()->id)->first();

    //         Log::info("org  Assigning Vehicle:" . $organisation);

    //         $data = $request->validate([

    //             'driver_id' => 'required|integer'
    //         ]);

    //         if (!$car) {
    //             return response()->json([
    //                 'error' => 'Vehicle not found'
    //             ], 404);
    //         }

    //         if ($car->status === 'active') {
    //             return response()->json([
    //                 'error' => 'Vehicle already has a driver'
    //             ], 400);
    //         }

    //         if (!$organisation) {
    //             return response()->json([
    //                 'message' => 'Unauthorised',
    //             ], 401);
    //         }

    //         if ($car->organisation_id !== $organisation->id) {
    //             return response()->json([
    //                 'message' => 'Unauthorised',
    //             ], 401);
    //         }

    //         $driver = Driver::find($data['driver_id']);

    //         if (!$driver) {
    //             return response()->json([
    //                 'error' => 'Driver not found'
    //             ], 404);
    //         }

    //         if ($driver->vehicle) {
    //             return response()->json([
    //                 'error' => 'Driver already has a vehicle'
    //             ], 400);
    //         }

    //         if (!$driver->license) {
    //             return response()->json([
    //                 'error' => 'Driver has no license'
    //             ], 400);
    //         }

    //         if (!$driver->license_expiry || strtotime($driver->license_expiry) < time()) {
    //             return response()->json([
    //                 'error' => 'Driver license has expired'
    //             ], 400);
    //         }

    //         $car->driver_id = $driver->id;
    //         $car->status = 'active';
    //         $car->save();

    //         return response()->json([
    //             'message' => 'Driver assigned to vehicle successfully',
    //             'vehicle' => $car
    //         ], 200);

    //     } catch (Exception $e) {
    //         Log::error('ERROR ASSIGNING DRIVER TO VEHICLE');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'Error occurred while assigning driver to vehicle',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }



    public function assign_driver($vehicle, Request $request)
    {
        try {
            // Check if the authenticated user has the 'assign driver' permission
            if (!auth()->user()->can('assign driver')) {
                return response()->json([
                    'message' => 'Forbidden',
                ], 403);
            }

            $car = Vehicle::find($vehicle);

            Log::info("Vehicle being assigned: " . $car);

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

            // if (!$driver->license) {
            //     return response()->json([
            //         'error' => 'Driver has no license'
            //     ], 400);
            // }

            // if (!$driver->license_expiry || strtotime($driver->license_expiry) < time()) {
            //     return response()->json([
            //         'error' => 'Driver license has expired'
            //     ], 400);
            // }

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