<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $settingPermissions = PermissionGroup::where('group_name', 'settings')->get();
        $dashboardPermissions = PermissionGroup::where('group_name', 'dashboard')->get();
        $employeePermissions = PermissionGroup::where('group_name', 'employee')->get();
        $organisationPermissions = PermissionGroup::where('group_name', 'organisation')->get();
        $driversPermissions = PermissionGroup::where('group_name', 'drivers')->get();
        $licensePermissions = PermissionGroup::where('group_name', 'license')->get();
        $psv_badgePermissions = PermissionGroup::where('group_name', 'psv_badge')->get();
        $driver_performancePermissions = PermissionGroup::where('group_name', 'driver_performance')->get();
        $vehiclePermissions = PermissionGroup::where('group_name', 'vehicle')->get();
        $vehicle_insurancePermissions = PermissionGroup::where('group_name', 'vehicle_insurance')->get();
        $routePermissions = PermissionGroup::where('group_name', 'route')->get();
        $route_locationPermissions = PermissionGroup::where('group_name', 'route_location')->get();
        $tripPermissions = PermissionGroup::where('group_name', 'trip')->get();
        $insurance_companyPermissions = PermissionGroup::where('group_name', 'insurance_company')->get();
        $vehicle_maintenancePermissions = PermissionGroup::where('group_name', 'vehicle_maintenance')->get();
        return view('role.create', compact(
            'settingPermissions',
            'dashboardPermissions',
            'employeePermissions',
            'organisationPermissions',
            'driversPermissions',
            'licensePermissions',
            'psv_badgePermissions',
            'driver_performancePermissions',
            'vehiclePermissions',
            'vehicle_insurancePermissions',
            'routePermissions',
            'route_locationPermissions',
            'tripPermissions',
            'insurance_companyPermissions',
            'vehicle_maintenancePermissions',
        ));
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