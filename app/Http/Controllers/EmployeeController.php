<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Customer;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // try {
        //     $customers = Customer::all();

        //     return response()->json([
        //         'message' => 'Customers retrieved successfully',
        //         'customers' => $customers
        //     ], 200);
        // } catch (Exception $e) {
        //     Log::info('RETRIEVE CUSTOMERS ERROR');
        //     Log::info($e);
        //     return response()->json([
        //         'message' => 'An error occurred while fetching customers',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }

        $customers = Customer::with('user')->get();
        return view('employee', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('ACCESSED');
        try {
            // Log the authenticated user ID
            $authenticatedUserId = Auth::id();
            Log::info('Authenticated User ID: ' . $authenticatedUserId);

            // Is request contains an array or a single object
            $customersData = $request->all();
            $isSingleCustomer = isset($customersData['name']);

            if ($isSingleCustomer) {
                $data = $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'phone' => 'required|string',
                    'password' => 'required|string',
                    'organisation_id' => 'required|integer|exists:organisations,id',
                    'organisation_code' => 'required|string',
                ]);
                //single customer in an array
                $customers = [$customersData];
            } else {
                $data = $request->validate([
                    '*.name' => 'required|string',
                    '*.email' => 'required|email|unique:users,email',
                    '*.phone' => 'required|string',
                    '*.password' => 'required|string',
                    '*.organisation_id' => 'required|integer|exists:organisations,id',
                    '*.organisation_code' => 'required|string',
                ]);
                // Handle multiple customers
                $customers = $customersData;
            }

            $createdCustomers = [];

            foreach ($customers as $customerData) {
                // Create a new user
                $user = User::create([
                    'name' => $customerData['name'],
                    'email' => $customerData['email'],
                    'phone' => $customerData['phone'],
                    'password' => bcrypt($customerData['password']),
                ]);

                // Assign the "customer" role to the user
                $user->assignRole('customer');

                // Create a new customer associated with the user and organisation
                $customer = Customer::create([
                    'user_id' => $user->id,
                    'organisation_id' => $customerData['organisation_id'],
                    'customer_organisation_code' => $customerData['organisation_code'],
                    'created_by' => $authenticatedUserId,
                ]);

                $createdCustomers[] = $customer;
            }

            return response()->json([
                'message' => 'Customers created successfully',
                'customers' => $data
            ], 201);
        } catch (Exception $e) {
            Log::error('CREATE CUSTOMER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     try {
    //         // Retrieve the customer with the user and creator details
    //         $customer = Customer::with(['user', 'creator'])->findOrFail($id);

    //         // Prepare the response data
    //         $response = [
    //             'id' => $customer->id,
    //             'created_by' => [
    //                 'id' => $customer->creator->id,
    //                 'name' => $customer->creator->name,
    //                 'email' => $customer->creator->email
    //             ],
    //             'user' => [
    //                 'id' => $customer->user->id,
    //                 'name' => $customer->user->name,
    //                 'email' => $customer->user->email,
    //                 'phone' => $customer->user->phone
    //             ],
    //             'organisation_id' => $customer->organisation_id,
    //             'customer_organisation_code' => $customer->customer_organisation_code
    //         ];

    //         return response()->json([
    //             'message' => 'Customer retrieved successfully',
    //             'customer' => $response
    //         ], 200);
    //     } catch (Exception $e) {
    //         Log::error('RETRIEVE CUSTOMER ERROR');
    //         Log::error($e);
    //         return response()->json([
    //             'message' => 'An error occurred while fetching customer',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }



    public function show(string $id)
    {
        try {
            // Retrieve the customer with the user, creator, and organisation details
            $customer = Customer::with([
                'user',
                'creator',
                'organisation.user'
            ])->findOrFail($id);

            // Prepare the response data
            $response = [
                'id' => $customer->id,
                'created_by' => [
                    'id' => $customer->creator->id,
                    'name' => $customer->creator->name,
                    'email' => $customer->creator->email,
                    "phone" => $customer->creator->phone,
                    "address" => $customer->creator->address,
                    "avatar" => $customer->creator->avatar,
                    "organisation" => $customer->creator->organisation
                ],
                'user' => [
                    'id' => $customer->user->id,
                    'name' => $customer->user->name,
                    'email' => $customer->user->email,
                    "phone" => $customer->user->phone,
                    "address" => $customer->user->address,
                    "avatar" => $customer->user->avatar,
                    "organisation" => $customer->user->organisation
                ],
                'organisation' => [
                    'id' => $customer->organisation->id,
                    'name' => $customer->organisation->user->name,
                    "phone" => $customer->organisation->user->phone,
                    "address" => $customer->organisation->user->address,
                    "avatar" => $customer->organisation->user->avatar,
                    "organisation" => $customer->organisation->user->organisation
                ],
                'organisation_id' => $customer->organisation_id,
                'customer_organisation_code' => $customer->customer_organisation_code
            ];

            return response()->json([
                'message' => 'Customer retrieved successfully',
                'customer' => $response
            ], 200);
        } catch (Exception $e) {
            Log::error('RETRIEVE CUSTOMER ERROR');
            Log::error($e);
            return response()->json([
                'message' => 'An error occurred while fetching customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */


      public function create(){
         return view('employee.create');
      }

    public function edit(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        return view('employee.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::find($id);
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();

            if (!$customer) {
                return response()->json([
                    'message' => 'Customer not found',
                ], 404);
            }

            if (!$organisation) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            if ($customer->organisation_id !== $organisation->id) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'string',
                'avatar' => 'string',
            ]);

            $customer->user->name = $data['name'];
            $customer->user->email = $data['email'];
            $customer->user->phone = $data['phone'];
            $customer->user->address = $data['address'];
            $customer->user->avatar = $data['avatar'];
            $customer->user->save();

            return response()->json([
                'message' => 'Customer updated successfully',
                'customer' => $customer->user
            ], 200);
        } catch (Exception $e) {
            Log::info('UPDATE CUSTOMER ERROR');
            Log::info($e);
            return response()->json([
                'message' => 'An error occurred while updating customer',
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

            $customer = Customer::find($id);
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();

            if (!$customer) {
                return response()->json([
                    'message' => 'Customer not found',
                ], 404);
            }

            if (!$organisation) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            if ($customer->organisation_id !== $organisation->id) {
                return response()->json([
                    'message' => 'Unauthorised',
                ], 401);
            }

            return response()->json([
                'message' => 'Customer deleted successfully',
                'customer' => $customer->user
            ], 200);
        } catch (Exception $e) {
            Log::info('DELETE CUSTOMER ERROR');
            Log::info($e);
            return response()->json([
                'message' => 'An error occurred while deleting customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}