<?php

namespace App\Http\Controllers;

use Database\Seeders\PermissionsByActions;
use Exception;
use App\Models\UserRole;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = UserRole::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dashboardPermissions = PermissionsByActions::DASHBOARD_MANAGEMENT_PERMISSIONS;
        $profilePermissions = PermissionsByActions::PROFILE_MANAGEMENT_PERMISSIONS;
        $employeePermissions = PermissionsByActions::EMPLOYEE_MANAGEMENT_PERMISSIONS;
        $organisationPermissions = PermissionsByActions::ORGANISATION_MANAGEMENT_PERMISSIONS;
        $driverPermissions = PermissionsByActions::DRIVER_MANAGEMENT_PERMISSIONS;
        $driverLicensePermissions = PermissionsByActions::DRIVER_LICENSE_MANAGEMENT_PERMISSIONS;
        $driverPSVBadgePermissions = PermissionsByActions::DRIVER_PSVBADGE_MANAGEMENT_PERMISSIONS;
        $driverPerformancePermissions = PermissionsByActions::DRIVER_PERFORMANCE_MANAGEMENT_PERMISSIONS;
        $vehiclePermissions = PermissionsByActions::VEHICLE_MANAGEMENT_PERMISSIONS;
        $vehicleInsurancePermissions = PermissionsByActions::VEHICLE_INSURANCE_MANAGEMENT_PERMISSIONS;
        $vehicleInspCertPermissions = PermissionsByActions::VEHICLE_INSPECTION_CERTIFICATE_MANAGEMENT_PERMISSIONS;
        $routePermissions = PermissionsByActions::ROUTE_MANAGEMENT_PERMISSIONS;
        $routeLocationPermissions = PermissionsByActions::ROUTE_LOCATION_MANAGEMENT_PERMISSIONS;
        $tripPermissions = PermissionsByActions::TRIP_MANAGEMENT_PERMISSIONS;
        $insuranceCompanyPermissions = PermissionsByActions::INSURANCE_COMPANY_MANAGEMENT_PERMISSIONS;
        $insuranceRecurringPeriodPermissions = PermissionsByActions::INSURANCE_COMPANY_RECURRING_PERIODS_MANAGEMENT_PERMISSIONS;
        $maintenancePermissions = PermissionsByActions::MAINTENANCE_MANAGEMENT_PERMISSIONS;
        $refuellingPermissions = PermissionsByActions::FUELLING_MANAGEMENT_PERMISSIONS;
        $refuellingStationPermissions = PermissionsByActions::FUELLING_STATIONS_MANAGEMENT_PERMISSIONS;
        $reportPermissions = PermissionsByActions::REPORTS_MANAGEMENT_PERMISSIONS;
        $rolePermissions = PermissionsByActions::ROLE_MANAGEMENT_PERMISSIONS;
        $permissionPermissions = PermissionsByActions::PERMISSION_MANAGEMENT_PERMISSIONS;
        $settingsPermissions = PermissionsByActions::SETTINGS_MANAGEMENT_PERMISSIONS;
        $bankAccountPermissions = PermissionsByActions::BANK_ACCOUNT_MANAGEMENT_PERMISSIONS;
        return view('role.create', compact(
            'dashboardPermissions',
            'profilePermissions',
            'employeePermissions',
            'organisationPermissions',
            'driverPermissions',
            'driverLicensePermissions',
            'driverPSVBadgePermissions',
            'driverPerformancePermissions',
            'vehiclePermissions',
            'vehicleInsurancePermissions',
            'vehicleInspCertPermissions',
            'routePermissions',
            'routeLocationPermissions',
            'tripPermissions',
            'insuranceCompanyPermissions',
            'insuranceRecurringPeriodPermissions',
            'maintenancePermissions',
            'refuellingPermissions',
            'refuellingStationPermissions',
            'reportPermissions',
            'rolePermissions',
            'permissionPermissions',
            'settingsPermissions',
            'bankAccountPermissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $data = $request->validate([
                'name' => 'required|string|unique:user_roles,name',
                'permissions' => 'required|array',
            ]);

            // Start a database transaction
            DB::beginTransaction();

            // Create a new role with guard_name set to 'web'
            $role = Role::firstOrCreate([
                'name' => $data['name'],
            ]);

            foreach ($data['permissions'] as $permissionId) {
                $permission = Permission::find($permissionId);
                if (!$permission) {
                    \Spatie\Permission\Models\Permission::create([
                        'name' => $permissionId,
                        'guard_name' => 'web',
                    ]);
                }
            }

            // Attach permissions to the role
            $role->permissions()->sync($data['permissions']);

            // Commit the transaction
            DB::commit();

            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } catch (Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            Log::error('Error creating role: ');
            Log::info($e);
            return redirect()->back()->with('error', 'An error occurred while creating the role. Please try again.')->withInput();
        }
    }




    // public function store(Request $request)
    // {
    //     try {
    //         // Validate the request data
    //         $data = $request->validate([
    //             'name' => 'required|string|unique:roles,name',
    //             'permissions' => 'required|array',
    //         ]);

    //       Log::info('data from the form of creating new Role  with Permissions : ');
    //        Log::info($data);


    //         // Start a database transaction
    //         DB::beginTransaction();

    //         // Create a new role with guard_name set to 'web'
    //         $role = Role::create([
    //             'name' => $data['name'],
    //             'guard_name' => 'web',
    //         ]);

    //         // Process permissions
    //         $permissionIds = [];
    //         foreach ($data['permissions'] as $permissionId) {
    //             $permission = Permission::find($permissionId);
    //             if ($permission) {
    //                 $permissionIds[] = $permission->id;
    //             }
    //         }

    //         // Attach permissions to the role
    //         $role->syncPermissions($permissionIds);

    //         // Commit the transaction
    //         DB::commit();

    //         return redirect()->route('roles.index')->with('success', 'Role created successfully');
    //     } catch (Exception $e) {
    //         // Rollback the transaction if something goes wrong
    //         DB::rollBack();
    //         Log::error('Error creating role: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'An error occurred while creating the role. Please try again.')->withInput();
    //     }
    // }


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
