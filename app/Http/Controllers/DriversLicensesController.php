<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\DriversLicenses;

class DriversLicensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $licenses = Driver::all();
        return view('driver.license.index',compact('licenses'));

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
    public function show(DriversLicenses $driversLicenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriversLicenses $driversLicenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriversLicenses $driversLicenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriversLicenses $driversLicenses)
    {
        //
    }
}