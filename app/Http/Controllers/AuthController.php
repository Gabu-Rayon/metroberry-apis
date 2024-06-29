<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;

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
            // Retrieve the array of users from the request
            $usersData = $request->input('users');

            // Check if users data is provided and is an array
            if (!is_array($usersData)) {
                return response()->json([
                    'message' => 'Invalid input data. Expected an array of users.',
                ], 400);
            }

            // Loop through each user data
            foreach ($usersData as $userdata) {
                // Validate each user data
                $validatedData = Validator::make($userdata, [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string',
                    'phone' => 'required|string',
                    'role' => 'required|string|exists:roles,name',
                    'organisation_id' => 'required_if:role,customer|exists:organisations,id',
                    'customer_organisation_code' => 'required_if:role,customer|string'
                ])->validate();

                // Create the user
                $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                    'phone' => $validatedData['phone']
                ]);

                $role = Role::findByName($validatedData['role'], 'web');

                // Set the authenticated user ID as the creator
                $authenticatedUserId = $user->id;

                $user->assignRole($role);

                // Check and create related entities based on the role
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
                        'organisation_id' => $validatedData['organisation_id'],
                        'customer_organisation_code' => $validatedData['customer_organisation_code'],
                        'created_by' => $authenticatedUserId,
                    ]);
                }
            }

            // Return success response
            return response()->json([
                'message' => 'Users registered successfully.',
            ], 200);

        } catch (\Exception $e) {
            // Log the error
            Log::error('An error occurred while registering users: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'message' => 'An error occurred while registering users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function login(Request $request)
    {

        Log::info('Login Request : ');
        Log::info($request);
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

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Logged out successfully'
            ], 200);

        } catch (Exception $e) {
            Log::error('ERROR LOGGING OUT USERS');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while logging out user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}