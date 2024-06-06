<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Exception;
use Illuminate\Http\Request;
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
}
