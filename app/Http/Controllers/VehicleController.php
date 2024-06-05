<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $vehicles = Vehicle::where('created_by', Auth::id())->get();
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
    public function store(Request $request) {
        try {

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

            $vehicle = Vehicle::create([
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

            return response()->json([
                'message' => 'Vehicle created successfully',
                'vehicle' => $vehicle
            ], 201);
        } catch (Exception $e) {
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

            if (!$vehicle) {
                return response()->json([
                    'error' => 'Vehicle not found'
                ], 404);
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

            Log::info('VEHICLE VALIDATION DATA');
            Log::info($data);

            $vehicle->update($data);

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
}
