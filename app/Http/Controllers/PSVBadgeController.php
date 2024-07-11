<?php

namespace App\Http\Controllers;

use App\Models\PSVBadge;
use Illuminate\Http\Request;

class PSVBadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $psvbadges = PSVBadge::all();
        return view('driver.psvbadge.index', compact('psvbadges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('driver.psvbadge.create');
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
    public function show(PSVBadge $pSVBadge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PSVBadge $pSVBadge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PSVBadge $pSVBadge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PSVBadge $pSVBadge)
    {
        //
    }
}
