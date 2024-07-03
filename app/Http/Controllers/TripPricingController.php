<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\TripPricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TripPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Retrieve all Trip Pricing with related creator, Route, and Ride Type details
            $tripPricing = TripPricing::with([
                'creator:id,name,email',
                'route:id,county,location,start_location,end_location',
                'rideType:id,type,description'
            ])->get();

            Log::info('All Trip Pricing from the API:', $tripPricing->toArray());

            $response = $tripPricing->map(function ($tripPricingValue) {
                return [
                    'id' => $tripPricingValue->id,
                    'ride_type_id' => $tripPricingValue->ride_type_id,
                    'route_id' => $tripPricingValue->route_id,
                    'base_price' => 'Kes ' . $tripPricingValue->base_price,
                    'price_per_km' => 'Kes ' . $tripPricingValue->price_per_km,
                    'price_per_minute' => 'Kes ' . $tripPricingValue->price_per_minute,
                    'creator' => $tripPricingValue->creator ? [
                        'id' => $tripPricingValue->creator->id,
                        'name' => $tripPricingValue->creator->name,
                        'email' => $tripPricingValue->creator->email,
                        'address' => $tripPricingValue->creator->address ?? null,
                    ] : null,
                    'route' => $tripPricingValue->route ? [
                        'id' => $tripPricingValue->route->id,
                        'county' => $tripPricingValue->route->county,
                        'location' => $tripPricingValue->route->location,
                        'start_location' => $tripPricingValue->route->start_location,
                        'end_location' => $tripPricingValue->route->end_location,
                    ] : null,
                    'rideType' => $tripPricingValue->rideType ? [
                        'id' => $tripPricingValue->rideType->id,
                        'type' => $tripPricingValue->rideType->type,
                        'description' => $tripPricingValue->rideType->description,
                    ] : null,
                ];
            });

            return response()->json([
                'Trip Pricing :' => $response
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING Trip Pricings');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while fetching Trip Pricings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method is typically used to show a form in a web application, not needed for an API
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

            $creator = User::find($userId);
            Log::info('CREATOR', ['creator' => $creator]);

            // Add the authenticated user ID to the request data
            $request->merge(['created_by' => $userId]);

            // Validate the request data
            $data = $request->validate([
                'ride_type_id' => 'required|exists:ride_types,id',
                'route_id' => 'required|exists:routes,id',
                'base_price' => 'required|numeric',
                'price_per_km' => 'required|numeric',
                'price_per_minute' => 'required|numeric',
            ]);


            $tripPricing = TripPricing::create([
                'ride_type_id' => $data['ride_type_id'],
                'route_id' => $data['route_id'],
                'base_price' => $data['base_price'],
                'price_per_km' => $data['price_per_km'],
                'price_per_minute' => $data['price_per_minute'],
                'created_by' => $userId,
                'status' => 'inactive'
            ]);

            // Create a new TripPricing record
            Log::info('Trip Pricing CREATED', ['Trip Price' => $tripPricing]);

            return response()->json([
                'message' => 'Trip pricing created successfully',
                'tripPricing' => $tripPricing
            ], 201);

        } catch (Exception $e) {
            Log::error('Error Adding New Trip Pricing');
            Log::error($e);
            return response()->json([
                'message' => 'Error Occurred While Add New Trip Pricing',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        try {
            $tripPricingValue = TripPricing::with([
                'creator:id,name,email',
                'route:id,county,location,start_location,end_location',
                'rideType:id,type,description'
            ])->findOrFail($id);
            Log::info('Trip Pricing SHOW', ['Trip Price' => $tripPricingValue]);
            $response = [
                'id' => $tripPricingValue->id,
                'ride_type_id' => $tripPricingValue->ride_type_id,
                'route_id' => $tripPricingValue->route_id,
                'base_price' => 'Kes ' . $tripPricingValue->base_price,
                'price_per_km' => 'Kes ' . $tripPricingValue->price_per_km,
                'price_per_minute' => 'Kes ' . $tripPricingValue->price_per_minute,
                'creator' => $tripPricingValue->creator ? [
                    'id' => $tripPricingValue->creator->id,
                    'name' => $tripPricingValue->creator->name,
                    'email' => $tripPricingValue->creator->email,
                    'address' => $tripPricingValue->creator->address ?? null,
                ] : null,
                'route' => $tripPricingValue->route ? [
                    'id' => $tripPricingValue->route->id,
                    'county' => $tripPricingValue->route->county,
                    'location' => $tripPricingValue->route->location,
                    'start_location' => $tripPricingValue->route->start_location,
                    'end_location' => $tripPricingValue->route->end_location,
                ] : null,
                'rideType' => $tripPricingValue->rideType ? [
                    'id' => $tripPricingValue->rideType->id,
                    'type' => $tripPricingValue->rideType->type,
                    'description' => $tripPricingValue->rideType->description,
                ] : null,
            ];

            return response()->json([
                'Trip Pricing : ' => $response
            ], 200);
        } catch (Exception $e) {
            Log::error('Error Fetching Trip Pricing');
            Log::error($e);
            return response()->json([
                'message' => 'Error Occurred While Fetching Trip Pricing',
                'error' => $e->getMessage()
            ], 500);
        }


        // return response()->json($tripPricing);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // This method is typically used to show a form in a web application, not needed for an API
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $data = $request->validate([
                'ride_type_id' => 'required|exists:ride_types,id',
                'base_price' => 'required|numeric',
                'price_per_km' => 'required|numeric',
                'price_per_minute' => 'required|numeric',
                'status' => 'required'
            ]);

            // Find the TripPricing record by ID
            $tripPricing = TripPricing::findOrFail($id);

            // Update the TripPricing record with the validated data
            $tripPricing->update($data);

            // Return a success response
            return response()->json([
                'message' => 'Trip pricing updated successfully',
                'tripPricing' => $tripPricing
            ], 200);
        } catch (Exception $e) {
            Log::error('Error Editing Trip Pricing');
            Log::error($e);
            return response()->json([
                'message' => 'Error Occurred While Editing Trip Pricing',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {
            $tripPricing = TripPricing::findOrFail($id);
            $tripPricing->delete();

            return response()->json([
                'message' => 'Trip pricing deleted successfully'
            ], 200);
        } catch (Exception $e) {
            Log::error('Error Editing Trip Pricing');
            Log::error($e);
            return response()->json([
                'message' => 'Error Occurred While Deleting Trip Pricing',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}