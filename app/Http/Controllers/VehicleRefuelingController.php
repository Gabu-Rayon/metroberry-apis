<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleRefuelingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('refueling');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('refueling.create'); 
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

     public function type(){
        return view('refueling.type');
     }
    public function station()
    {
        return view('refueling.station');
    }
    public function requisition()
    {
     return view('refueling.requisition');
    }
    public function typeCreate(){
        return view('refueling.type.create');
     }

     public function stationCreate(){
        return view('refueling.station.create');
     }

}