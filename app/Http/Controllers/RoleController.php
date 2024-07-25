<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        $data = $request->all();

        Log::info('data from Form  creating a new Role with Permissions :');
        Log::info($data);

        // Validate the request
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Create the role
            $role = Role::create(['name' => $data['name']]);

            // Assign permissions to the role
            $role->permissions()->sync($data['permissions']);

            DB::commit();

            return redirect()->route('permission.role')->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating role: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while creating the role')->withInput();
        }
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