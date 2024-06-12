<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $routes = Routes::where('created_by', Auth::id())->get();
            return response()->json([
                'routes' => $routes
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING All the ROUTES');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while fetching routes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $routedata = $request->validate([
                'county' => 'required|string',
                'location' => 'required|string',
                'start_location' => 'required|string',
                'end_location' => 'required|string',
            ]);

            Log::info('Route za kwetu na ya kwetu tu');
            Log::info($routedata);

            $route = Routes::create([
                'county' => $routedata['county'],
                'location' => $routedata['location'],
                'start_location' => $routedata['start_location'],
                'end_location' => $routedata['end_location'],
                'created_by' => Auth::id(),
            ]);

            $route->save();

            return response()->json([
                'Routes' => $route,
            ], 201);


        } catch (Exception $e) {
            Log::error('Error Adding A new Route');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while Adding A new Route',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
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
}