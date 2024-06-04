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
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
