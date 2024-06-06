<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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


    public function customerLogin(Request $request)
    {
        try {
            // Validate the request
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Log validation data
            Log::info('Customer LOGIN VALIDATION DATA');
            Log::info($data);

            // Attempt to login the user
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                // Authentication passed, get the authenticated user
                $user = Auth::user();

                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Invalid email or password',
                ], 401);
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('ERROR DURING CUSTOMER LOGIN');
            Log::error($e);

            return response()->json([
                'message' => 'Error occurred during login',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}