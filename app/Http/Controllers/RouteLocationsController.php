<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Routes;
use Illuminate\Http\Request;
use App\Models\RouteLocations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RouteLocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routelocations = RouteLocations::all();
        $routes = Routes::all();

        return view('route.locations.index', compact('routelocations','routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = Routes::all();
        return view('route.locations.create', compact('routes'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            Log::info('Data from the Creating a route Location Form :');
            Log::info($data);

            $validator = Validator::make($data, [
                'route' => 'required|string',
                'type' => 'required|string',
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR WHILE ADDING NEW ROUTE');
                Log::error($validator->errors()->first());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $routeName = $data['start_location'] . ' - ' . $data['end_location'];

            Log::info('Route Name Generated :');
            Log::info($routeName);

            DB::beginTransaction();

            $route = Routes::create([
                'county' => $data['county'],
                'name' => $routeName,
                'created_by' => 1,
            ]);

            RouteLocations::create([
                'route_id' => $route->id,
                'name' => $data['start_location'],
                'is_start_location' => true,
                'is_end_location' => false,
                'is_waypoint' => false,
            ]);

            RouteLocations::create([
                'route_id' => $route->id,
                'name' => $data['end_location'],
                'is_start_location' => false,
                'is_end_location' => true,
                'is_waypoint' => false,
            ]);

            DB::commit();

            return redirect()->route('route.index')->with('success', 'Route Added Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error Adding New Routes');
            Log::error($e);
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     * 
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

    public function getAllRouteWaypoints(Request $request)
    {
        Log::info('HERE');
        try {
            $routeLocationWaypoints = RouteLocations::where('route_id', $request->route_id)
                ->get(['name', 'id', 'point_order']);
            Log::info('Data request for getting all waypoints for route ID: ' . $request->route_id);
            Log::info('Retrieved waypoints: ', $routeLocationWaypoints->toArray());

            return response()->json($routeLocationWaypoints);
        } catch (\Exception $e) {
            // Log any errors
            Log::error('Error fetching waypoints: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch waypoints'], 500);
        }
    }
}