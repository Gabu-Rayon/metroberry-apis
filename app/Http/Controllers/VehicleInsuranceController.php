<?php

namespace App\Http\Controllers;

use App\Models\VehicleInsurance;
use Illuminate\Http\Request;

class VehicleInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicle.insurance.create');
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
    public function show(VehicleInsurance $vehicleInsurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleInsurance $vehicleInsurance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleInsurance $vehicleInsurance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleInsurance $vehicleInsurance)
    {
        //
    }
}