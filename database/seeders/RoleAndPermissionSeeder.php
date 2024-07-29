<?php

namespace Database\Seeders;

use App\Http\Utils\Permissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use const App\Http\Utils\BANK_ACCOUNT_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\DASHBOARD_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\DRIVER_LICENSE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\DRIVER_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\DRIVER_PERFORMANCE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\DRIVER_PERMISSIONS;
use const App\Http\Utils\DRIVER_PSVBADGE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\EMPLOYEE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\EMPLOYEE_PERMISSIONS;
use const App\Http\Utils\FUELLING_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\FUELLING_STATIONS_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\INSURANCE_COMPANY_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\INSURANCE_COMPANY_RECURRING_PERIODS_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\MAINTENANCE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\ORGANISATION_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\ORGANISATION_PERMISSIONS;
use const App\Http\Utils\PERMISSION_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\PROFILE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\REFUELLING_STATION_PERMISSIONS;
use const App\Http\Utils\REPORTS_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\ROLE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\ROUTE_LOCATION_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\ROUTE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\SETTINGS_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\TRIP_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\VEHICLE_INSPECTION_CERTIFICATE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\VEHICLE_INSURANCE_MANAGEMENT_PERMISSIONS;
use const App\Http\Utils\VEHICLE_MANAGEMENT_PERMISSIONS;

require_once __DIR__ . '/../../utils/admin_permissions.php';

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'admin',
            'organisation',
            'customer',
            'driver',
            'refueling_station',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $permissions = array_merge(
            DASHBOARD_MANAGEMENT_PERMISSIONS,
            PROFILE_MANAGEMENT_PERMISSIONS,
            EMPLOYEE_MANAGEMENT_PERMISSIONS,
            ORGANISATION_MANAGEMENT_PERMISSIONS,
            DRIVER_MANAGEMENT_PERMISSIONS,
            DRIVER_LICENSE_MANAGEMENT_PERMISSIONS,
            DRIVER_PSVBADGE_MANAGEMENT_PERMISSIONS,
            DRIVER_PERFORMANCE_MANAGEMENT_PERMISSIONS,
            VEHICLE_MANAGEMENT_PERMISSIONS,
            VEHICLE_INSURANCE_MANAGEMENT_PERMISSIONS,
            VEHICLE_INSPECTION_CERTIFICATE_MANAGEMENT_PERMISSIONS,
            ROUTE_MANAGEMENT_PERMISSIONS,
            ROUTE_LOCATION_MANAGEMENT_PERMISSIONS,
            TRIP_MANAGEMENT_PERMISSIONS,
            INSURANCE_COMPANY_MANAGEMENT_PERMISSIONS,
            INSURANCE_COMPANY_RECURRING_PERIODS_MANAGEMENT_PERMISSIONS,
            MAINTENANCE_MANAGEMENT_PERMISSIONS,
            FUELLING_MANAGEMENT_PERMISSIONS,
            FUELLING_STATIONS_MANAGEMENT_PERMISSIONS,
            REPORTS_MANAGEMENT_PERMISSIONS,
            ROLE_MANAGEMENT_PERMISSIONS,
            PERMISSION_MANAGEMENT_PERMISSIONS,
            SETTINGS_MANAGEMENT_PERMISSIONS,
            BANK_ACCOUNT_MANAGEMENT_PERMISSIONS
        );



        /**
         * Create all permissions
         */
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::where('name', 'admin')->first();
        $organisation = Role::where('name', 'organisation')->first();
        $customer = Role::where('name', 'customer')->first();
        $driver = Role::where('name', 'driver')->first();
        $refuellingStation = Role::where('name', 'refueling_station')->first();

        $admin->syncPermissions(Permissions::$admin_permissions);
        $organisation->syncPermissions(Permissions::$organisation_permissions);
        $customer->syncPermissions(Permissions::$customer_permissions);
        $driver->syncPermissions(Permissions::$driver_permissions);
        $refuellingStation->syncPermissions(Permissions::$refueling_station_permissions);
    }
}
