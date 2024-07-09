<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // try {
        //     if (Auth::user()->hasRole('admin')) {
        //         $organisation = Organisation::all();
        //         foreach ($organisation as $org) {
        //             $org->load('user');
        //         }
        //         return response()->json([
        //             'count' => count($organisation),
        //             'organisations' => $organisation
        //         ], 200);
        //     }
        //     $organisation = Organisation::where('created_by', Auth::id())->get();
        //     return response()->json([
        //         'organisations' => $organisation
        //     ], 200);
        // } catch (Exception $e) {
        //     Log::error('ERROR FETCHING Organisation');
        //     Log::error($e);
        //     return response()->json([
        //         'message' => 'An error occurred while fetching organisations',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }


        $organisations = Organisation::all();
        return view('organisation',compact('organisations'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organisation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string',
                'password' => 'required|string',
            ]);

            // Log the user creating the organisation
            $adminUser = User::where('id', auth()->user()->id)->first();
            Log::info('User with role of Admin Creating the Organisation');
            Log::info($adminUser);

            // Create a new user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
            ]);

            // Create a new organisation
            $organisation = Organisation::create([
                // user_id is the id of organisation in the users table
                'user_id' => $user->id,
                // created_by is the id of user with role of admin in the users table
                'created_by' => Auth::id(),
            ]);

            // Save the organisation
            $organisation->save();

            return response()->json([
                'message' => 'Organisation created successfully',
                'organisation' => $organisation
            ], 201);
        } catch (Exception $e) {
            Log::error('Error Creating Organisation');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while creating organisation',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $organisation = Organisation::where('id', $id)->first();
            if (!$organisation) {
                return response()->json([
                    'message' => 'Organisation not found'
                ], 404);
            }
            $organisation->load('user');
            return response()->json([
                'organisation' => $organisation
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING Organisation');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while fetching organisation',
                'error' => $e->getMessage()
            ], 500);
        }
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