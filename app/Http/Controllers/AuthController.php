<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Organisation;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    // public function register(Request $request)
    // {
    //     try {
    //         $userdata = $request->validate([
    //             'name' => 'required|string',
    //             'email' => 'required|email|unique:users',
    //             'password' => 'required|string',
    //             'phone' => 'required|string',
    //             'role' => 'required|string|exists:roles,name',
    //             'organisation_id' => 'required_if:role,customer|exists:organisations,id'
    //         ]);

    //         Log::info('USER DATA');
    //         Log::info($userdata);

    //         $user = User::create([
    //             'name' => $userdata['name'],
    //             'email' => $userdata['email'],
    //             'password' => bcrypt($userdata['password']),
    //             'phone' => $userdata['phone']
    //         ]);

    //         $role = Role::findByName($userdata['role'], 'web');

    //         Log::info('ROLE');
    //         Log::info($role);

    //         // Log the authenticated user ID
    //         $authenticatedUserId = $user->id;
    //         Log::info('Authenticated User ID: ' . $authenticatedUserId);

    //         // Check if a user is authenticated
    //         if (!$authenticatedUserId) {
    //             throw new Exception('No authenticated user found.');
    //         }

    //         $user->assignRole($role);

    //         if ($role->name === 'driver') {
    //             Driver::create([
    //                 'user_id' => $user->id,
    //                 'created_by' => $authenticatedUserId,
    //             ]);
    //         }

    //         if ($role->name === 'organisation') {
    //             Organisation::create([
    //                 'user_id' => $user->id,
    //                 'created_by' => $authenticatedUserId,
    //             ]);
    //         }

    //         if ($role->name === 'customer') {
    //             Customer::create([
    //                 'user_id' => $user->id,
    //                 'organisation_id' => $userdata['organisation_id'],
    //                 'customer_organisation_code' => "Org202",
    //                 'created_by' => $authenticatedUserId,
    //             ]);
    //         }

    //         $token = $user->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             'access_token' => $token,
    //             'token_type' => 'Bearer',
    //             'user' => $user,
    //         ], 201);

    //     } catch (Exception $e) {
    //         Log::error('ERROR REGISTERING USERS');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'An error occurred while registering user',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }



    public function register(Request $request)
    {
        try {
            $userdata = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string',
                'phone' => 'required|string',
                'role' => 'required|string|exists:roles,name',
                'organisation_id' => 'required_if:role,customer|exists:organisations,id'
            ]);

            Log::info('USER DATA');
            Log::info($userdata);

            $user = User::create([
                'name' => $userdata['name'],
                'email' => $userdata['email'],
                'password' => bcrypt($userdata['password']),
                'phone' => $userdata['phone']
            ]);

            $role = Role::findByName($userdata['role'], 'web');

            Log::info('ROLE');
            Log::info($role);

            // Set the authenticated user ID as the creator
            $authenticatedUserId = $user->id;
            Log::info('Authenticated User ID: ' . $authenticatedUserId);

            $user->assignRole($role);

            if ($role->name === 'driver') {
                Driver::create([
                    'user_id' => $user->id,
                    'created_by' => $authenticatedUserId,
                ]);
            }

            if ($role->name === 'organisation') {
                Organisation::create([
                    'user_id' => $user->id,
                    'created_by' => $authenticatedUserId,
                ]);
            }

            if ($role->name === 'customer') {
                Customer::create([
                    'user_id' => $user->id,
                    'organisation_id' => $userdata['organisation_id'],
                    'customer_organisation_code' => "Org202",
                    'created_by' => $authenticatedUserId,
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 201);

        } catch (Exception $e) {
            Log::error('ERROR REGISTERING USERS');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while registering user',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $user = User::where('email', $credentials['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('USER LOGGED IN PERMISSIONS');
            Log::info($user->getAllPermissions());

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 200);


        } catch (Exception $e) {
            Log::error('ERROR LOGGING IN USERS');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while logging in user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}