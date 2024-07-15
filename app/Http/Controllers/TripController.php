<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\Trip;
use App\Models\Routes;
use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\RouteSignatureParameters;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $trips = Trip::all();
            Log::info('All Trips Made from the Api :' . $trips);
            return response()->json([
                'trips' => $trips
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING TRIPS');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while fetching trips',
                'error' => $e->getMessage()
            ], 500);
        }

        // $trips = Trip::all();
        // return response()->json($trips);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Typically not used in APIs
        //where name will be from users table and id is from Customers table
        $employees = Customer::all();
        //routes
        $routes = Routes::all();
        return view('trips.create', compact('employees', 'routes'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     */



    // public function store(Request $request)
    // {
    //     try {
    //         $data = $request->validate([
    //             'customer_id' => 'required|exists:customers,id',
    //             'vehicle_id' => 'required|exists:vehicles,id',
    //             'driver_id' => 'required|exists:drivers,id',
    //             'preferred_route_id' => 'required|exists:routes,id',
    //             'pick_up_time' => 'required|date_format:H:i',
    //             'drop_off_or_pick_up_date' => 'required|date',
    //             'pick_up_location' => 'required|in:Home,Office',
    //             'mileage_gps' => 'required|numeric',
    //             'mileage_can' => 'required|numeric',
    //             'engine_hours_gps' => 'required|numeric',
    //             'engine_hours_can' => 'required|numeric',
    //             'can_distance_till_service' => 'required|numeric',
    //             'average_fuel_consumption_litre_per_km' => 'required|numeric',
    //             'average_fuel_consumption_litre_per_hour' => 'required|numeric',
    //             'average_fuel_consumption_kg_per_km' => 'required|numeric',
    //         ]);

    //         $trip = Trip::create($data);

    //         return response()->json([
    //             'message' => 'Trip created successfully',
    //             'trip' => $trip
    //         ], 201);
    //     } catch (Exception $e) {
    //         Log::error('ERROR CREATING TRIP');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'An error occurred while creating trip',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


   
    public function store(Request $request)
    {
        try {            
            $data = $request->all();

            Log::info('Data from the form of Creating A Trip : ');
            Log::info($data);
            $creator = Auth::user();

            // Validate incoming request
             $validator = Validator::make($data, [
                'customer_id' => 'required|exists:customers,id',
                'preferred_route_id' => 'required|exists:routes,id',                
                'trip_date' => 'required|date',
                'shift_start_time' => 'required|date_format:H:i',
                'shift_end_time' => 'required|date_format:H:i',
                'dropOffLocation' => 'nullable|in:Home,Office',
                'drop_off_location' => 'nullable',
            ]);
            if ($validator->fails()) {
                Log::info('VALIDATION ERROR');
                Log::info($validator->errors());
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            } 
            
            //For pick_up_time will be the  shift_end_time
            // drop_off_or_pick_up_date will be trip date 
            //then if user select 'pick_up_location' => 'Home', and vice versa for Home 
            //  we then get there home address from the table of users  by referencing using the customer_id 
             //then we will get the lat and long of the address and store it in the database
               
              //then if user select 'dropOffLocation' => 'Office', and vice verse for Home
            //   we will get there organisation address by referecing using their customer_id then
            //     we get organisation address using the models relationship where the data for organisation is also in the users table 
              
            //then 
            // if user select  'drop_off_location' => '4',  which in this case will came id we will get the  


            // trip Schedule  
            // $tripScheduled = new Trip();
            // $tripScheduled->customer_id = $request->customer_id;
            // $tripScheduled->preferred_route = $request->preferred_route;
            // $tripScheduled->preferred_route_id = $request->preferred_route_id;
            // $tripScheduled->pick_up_time = $request->pick_up_time;
            // $tripScheduled->drop_off_or_pick_up_date = $request->drop_off_or_pick_up_date;
            // $tripScheduled->pick_up_points = $request->pick_up_points;
            // $tripScheduled->pick_up_location  = $pickUpLocation;
            // $tripScheduled->drop_off_location = $dropOffLocation;
            // $tripScheduled->status = 'schedule';
            // $tripScheduled->created_by = $creator;

            // $tripScheduled->save();

            // Optionally, redirect to a success page or return a response
            return redirect()->route('trip.schedule')->with('success', 'Trip scheduled successfully.');

        } catch (\Exception $e) {
            // Handle exceptions or errors
            // Log the error
            Log::error('Error Schedule trip: ' . $e->getMessage());

            // Optionally, redirect back with error message
            return back()->withInput()->withErrors(['error' => 'Failed to schedule trip. Please try again.']);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $trip = Trip::findOrFail($id);
            return response()->json($trip);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING TRIP');
            Log::error($e);
            return response()->json([
                'message' => 'Trip not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Typically not used in APIs
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'customer_organisation_code' => 'required|string',
                'customer_contact' => 'required|string',
                'home_address' => 'required|string',
                'vehicle_id' => 'required|exists:vehicles,id',
                'car_class' => 'required|string',
                'driver_id' => 'required|exists:drivers,id',
                'car_license_plate' => 'required|string',
                'preferred_route' => 'required|string',
                'pick_up_time' => 'required|date_format:H:i',
                'drop_off_or_pick_up_date' => 'required|date',
                'pick_up_location' => 'required|in:Home,Office',
                'mileage_gps' => 'required|numeric',
                'mileage_can' => 'required|numeric',
                'engine_hours_gps' => 'required|numeric',
                'engine_hours_can' => 'required|numeric',
                'can_distance_till_service' => 'required|numeric',
                'average_fuel_consumption_litre_per_km' => 'required|numeric',
                'average_fuel_consumption_litre_per_hour' => 'required|numeric',
                'average_fuel_consumption_kg_per_km' => 'required|numeric',
            ]);

            $trip = Trip::findOrFail($id);
            $trip->update($data);

            return response()->json([
                'message' => 'Trip updated successfully',
                'trip' => $trip
            ]);
        } catch (Exception $e) {
            Log::error('ERROR UPDATING TRIP');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while updating trip',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $trip = Trip::findOrFail($id);
            $trip->delete();

            return response()->json([
                'message' => 'Trip deleted successfully'
            ]);
        } catch (Exception $e) {
            Log::error('ERROR DELETING TRIP');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while deleting trip',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showMapRouteForm($tripId)
    {
        $trip = Trip::findOrFail($tripId);
        return view('map_route', compact('trip'));
    }


    public function mapTripToRoute(Request $request, $trip)
    {
        try {
            $data = $request->validate([
                'preferred_route_id' => 'required|integer',
            ]);
            $trip = Trip::findOrFail($trip);

            $trip->update($data);

            // Return a success response
            return response()->json([
                'message' => 'Route Preferred Mapped Successfully',
                'Trip Being Mapped to Preferred Route' => $trip
            ]);
        } catch (Exception $e) {
            Log::error('ERROR Mapping the Preferred Route');
            Log::error($e);

            return response()->json([
                'message' => 'An error occurred while mapping Preferred Route',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function mapTripToVehicle(Request $request, $trip)
    {
        try {
            $data = $request->validate([
                'vehicle_id' => 'required|integer',
                'driver_id' => 'required|integer',
            ]);
            $trip = Trip::findOrFail($trip);

            $trip->update($data);

            // Return a success response
            return response()->json([
                'message' => 'Vehicle Mapped Successfully',
                'Vehicle Being Mapped to Preferred Route' => $trip
            ]);
        } catch (Exception $e) {
            Log::error('ERROR Mapping the Vehicle');
            Log::error($e);

            return response()->json([
                'message' => 'An error occurred while mapping Vehicle',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function vehicleTripDataCollection($vehicle, Request $request)
    {
        try {
            // Retrieve the authenticated user
            $user = auth()->user();
            if (!$user->can('edit vehicle')) {
                return response()->json([
                    'message' => 'Forbidden',
                ], 403);
            }

            // Validate the request data
            $validatedData = $request->validate([
                'mileage_gps' => 'required|numeric',
                'mileage_can' => 'required|numeric',
                'engine_hours_gps' => 'required|numeric',
                'engine_hours_can' => 'required|numeric',
                'can_distance_till_service' => 'required|numeric',
                'average_fuel_consumption_litre_per_km' => 'required|numeric',
                'average_fuel_consumption_litre_per_hour' => 'required|numeric',
                'average_fuel_consumption_kg_per_km' => 'required|numeric',
            ]);
            //trip associated with the provided vehicle ID
            $trip = Trip::where('vehicle_id', $vehicle)->firstOrFail();

            // Update trip Vehicle Data Collected record with validated data
            $trip->update($validatedData);

            Log::info('Trip updated successfully', ['trip_id' => $trip->id]);

            return response()->json([
                'message' => 'Trip updated successfully',
                'trip' => $trip,
            ], 200);
        } catch (Exception $e) {
            Log::error('Error updating trip: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error occurred while updating trip',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function tripScheduled()
    {
        return view('trips.scheduled');
    }
    public function tripCompleted()
    {
        return view('trips.completed');

    }
    public function tripCancelled()
    {

        return view('trips.cancelled');
    }
    public function tripBilled()
    {
        return view('trips.billed');

    }

}