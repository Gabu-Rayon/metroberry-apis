<?php

namespace App\Http\Controllers;

use Exception;
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
        try {
            $organisation = Organisation::where('created_by', Auth::id())->get();
            return response()->json([
                'Organisations' => $organisation
            ], 200);
        } catch (Exception $e) {
            Log::error('ERROR FETCHING Organisation');
            Log::error($e);
            try {
                $organisation = Organisation::where('created_by', Auth::id())->get();
                return response()->json([
                    'All Organisations' => $organisation
                ], 200);
            } catch (Exception $e) {
                Log::error('ERROR FETCHING Organisations');
                Log::error($e);
                return response()->json([
                    'message' => 'Error occurred while fetching All Organisations',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            if (isset($data[0])) {
                // The data is an array of organisations
                $response = [];
                foreach ($data as $organisationData) {
                    $validatedData = Validator::make($organisationData, [
                        'organisation_name' => 'required|string',
                        'location' => 'required|string',
                        'address' => 'required|string',
                    ])->validate();

                    $organisation = Organisation::create([
                        'organisation_name' => $validatedData['organisation_name'],
                        'location' => $validatedData['location'],
                        'address' => $validatedData['address'],
                        'created_by' => Auth::id(),
                        'status' => true
                    ]);

                    $response[] = $organisation;
                }

                return response()->json([
                    'message' => 'Organisations added successfully',
                    'organisations' => $response
                ], 201);
            } else {
                // The data is a single organisation
                $validatedData = $request->validate([
                    'organisation_name' => 'required|string',
                    'location' => 'required|string',
                    'address' => 'required|string',
                ]);

                $organisation = Organisation::create([
                    'organisation_name' => $validatedData['organisation_name'],
                    'location' => $validatedData['location'],
                    'address' => $validatedData['address'],
                    'created_by' => Auth::id(),
                    'status' => true
                ]);

                return response()->json([
                    'message' => 'Organisation added successfully',
                    'organisation' => $organisation
                ], 201);
            }
        } catch (Exception $e) {
            Log::error('ERROR CREATING Organisation');
            Log::error($e);
            return response()->json([
                'message' => 'Error occurred while adding organisation(s)',
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