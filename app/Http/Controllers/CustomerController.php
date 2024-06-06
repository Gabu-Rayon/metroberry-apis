<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Organisation;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $organisation = Organisation::where('user_id', auth()->user()->id)->first();
            $customers = $organisation->customers;

            foreach ($customers as $customer) {
                $customer->name = $customer->user->name;
            }

            return response()->json([
                'message' => 'Customers retrieved successfully',
                'customers' => $customers
            ], 200);
        } catch (Exception $e) {
            Log::info('RETRIEVE CUSTOMERS ERROR');
            Log::info($e);
            return response()->json([
                'message' => 'An error occurred while fetching customers',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
       try {

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $organisation = Organisation::where('user_id', auth()->user()->id)->first();
        Log::info('ORGANISATION');
        Log::info($organisation);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'organisation_id' => $organisation->id,
        ]);

        return response()->json([
            'message' => 'Customer created successfully',
            'customer' => $user
        ], 201);
       }catch (Exception $e) {
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
     */
    public function show(string $id) {
        try {
            $customer = Customer::find($id);
            $customer->name = $customer->user->name;

            return response()->json([
                'message' => 'Customer retrieved successfully',
                'customer' => $customer
            ], 200);
        } catch (Exception $e) {
            Log::info('RETRIEVE CUSTOMER ERROR');
            Log::info($e);
            return response()->json([
                'message' => 'An error occurred while fetching customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
            ]);

            $customer = Customer::find($id);
            $customer->user->name = $data['name'];
            $customer->user->email = $data['email'];
            $customer->user->phone = $data['phone'];
            $customer->user->save();

            return response()->json([
                'message' => 'Customer updated successfully',
                'customer' => $customer
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
    public function destroy(string $id) {
        try {
            $customer = Customer::find($id);
            $customer->user->delete();

            return response()->json([
                'message' => 'Customer deleted successfully',
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
