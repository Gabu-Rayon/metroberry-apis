<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(){
        try {
            $routes = Routes::all();
            return view('route.index', compact('routes'));
        } catch (Exception $e) {
            Log::error('ERROR FETCHING ROUTES');
            Log::error($e);
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('route.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     try {

    //         $routedata = $request->validate([
    //             'county' => 'required|string',
    //             'location' => 'required|string',
    //             'start_location' => 'required|string',
    //             'end_location' => 'required|string',
    //         ]);

    //         Log::info('Route za kwetu na ya kwetu tu');
    //         Log::info($routedata);

    //         $route = Routes::create([
    //             'county' => $routedata['county'],
    //             'location' => $routedata['location'],
    //             'start_location' => $routedata['start_location'],
    //             'end_location' => $routedata['end_location'],
    //             'created_by' => Auth::id(),
    //         ]);

    //         $route->save();

    //         return response()->json([
    //             'Routes' => $route,
    //         ], 201);


    //     } catch (Exception $e) {
    //         Log::error('Error Adding A new Route');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'An error occurred while Adding A new Route',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'county' => 'required|string',
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                Log::error('VALIDATION ERROR WHILE ADDING NEW ROUTE');
                Log::error($validator->errors()->first());
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            DB::beginTransaction();

            Routes::create([
                'county' => $data['county'],
                'name' => $data['name'],
                'created_by' => 1,
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