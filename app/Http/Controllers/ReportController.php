<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Driver;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the employee report.
     */

    
    public function employeeReport(){
        $employees = Customer::with('trips')->get();
        return view('report.employee', compact('employees'));
    }

    public function driverReport(){
        $drivers = Driver::with('vehicle')->get();
        return view('report.driver', compact('drivers'));
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

    /**
     * Display the driver report.
     */

    /**
     * Display the vehicle report.
     */
    public function vehicleReport()
    {

        // Return the view with the data
        return view('report.vehicle');
    }

    /**
     * Display the vehicle requisition report.
     */
    public function vehicleRequisitionReport()
    {

        // Return the view with the data
        return view('report.admin.vehicle.requisition');
    }

    /**
     * Display the pick and drop requisition report.
     */
    public function pickDropRequisitionReport()
    {

        // Return the view with the data
        return view('report.admin.pickdrop.requisition');
    }

    /**
     * Display the refuel requisition report.
     */
    public function refuelRequisitionReport()
    {

        // Return the view with the data
        return view('report.admin.refuel.requisition');
    }

    /**
     * Display the purchase report.
     */
    public function purchaseReport()
    {

        // Return the view with the data
        return view('report.purchase');
    }

    /**
     * Display the expense report.
     */
    public function expenseReport()
    {

        // Return the view with the data
        return view('report.expense');
    }

    /**
     * Display the maintenance requisition report.
     */
    public function maintenanceReport()
    {

        // Return the view with the data
        return view('report.maintenance');
    }
}