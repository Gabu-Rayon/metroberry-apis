<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class Permissions
{
    static array $admin_permissions;
    static array $organisation_permissions;
    static array $customer_permissions;
    static array $driver_permissions;
    static array $refueling_station_permissions;
}

Permissions::$admin_permissions = array_merge(
    PermissionsByActions::DASHBOARD_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::PROFILE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::EMPLOYEE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::ORGANISATION_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::DRIVER_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::DRIVER_LICENSE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::DRIVER_PSVBADGE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::DRIVER_PERFORMANCE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::VEHICLE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::VEHICLE_INSURANCE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::VEHICLE_INSPECTION_CERTIFICATE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::ROUTE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::ROUTE_LOCATION_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::TRIP_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::INSURANCE_COMPANY_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::INSURANCE_COMPANY_RECURRING_PERIODS_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::MAINTENANCE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::FUELLING_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::FUELLING_STATIONS_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::REPORTS_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::ROLE_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::PERMISSION_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::SETTINGS_MANAGEMENT_PERMISSIONS,
    PermissionsByActions::BANK_ACCOUNT_MANAGEMENT_PERMISSIONS
);

Permissions::$organisation_permissions = [
    'view dashboard',
    'manage users',
    'view profile',
    'edit profile',
    'delete profile',
    'manage customers',
    'view customers',
    'create customer',
    'edit customer',
    'delete customer',
    'activate customer',
    'deactivate customer',
    'update customer',
    'activate customer',
    'deactivate customer',
    'import customers',
    'export customers',
    'manage drivers',
    'view drivers',
    'show driver',
    'manage vehicles',
    'view vehicles',
    'show vehicle',
    'manage routes',
    'view routes',
    'show route',
    'manage route locations',
    'view route locations',
    'show route location',
    'manage trips',
    'view trips',
    'schedule trip',
    'pay for trip',
    'manage settings',
    'view settings',
    'edit settings',
    'update settings',
    'export settings',
    'import settings',
];

Permissions::$customer_permissions = [
    'view profile',
    'edit profile',
    'delete profile',
    'manage trips',
    'view trips',
    'schedule trip',
];

Permissions::$driver_permissions = [
    'view profile',
    'edit profile',
    'delete profile',
    'cancel trip',
    'complete trip',
    'manage maintenance',
    'view maintenance',
    'show maintenance',
    'create maintenance',
    'edit maintenance',
    'manage fuelling',
    'view fuelling',
    'show fuelling',
    'create fuelling',
    'edit fuelling',
];

Permissions::$refueling_station_permissions = [
    'view dashboard',
    'view profile',
    'edit profile',
    'delete profile',
    'manage fuelling',
    'view fuelling',
    'show fuelling',
    'create fuelling',
    'edit fuelling',
    'delete fuelling',
    'activate fuelling',
    'deactivate fuelling',
    'export fuelling',
    'import fuelling',
];


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
            PermissionsByActions::DASHBOARD_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::PROFILE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::EMPLOYEE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::ORGANISATION_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::DRIVER_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::DRIVER_LICENSE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::DRIVER_PSVBADGE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::DRIVER_PERFORMANCE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::VEHICLE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::VEHICLE_INSURANCE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::VEHICLE_INSPECTION_CERTIFICATE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::ROUTE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::ROUTE_LOCATION_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::TRIP_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::INSURANCE_COMPANY_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::INSURANCE_COMPANY_RECURRING_PERIODS_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::MAINTENANCE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::FUELLING_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::FUELLING_STATIONS_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::REPORTS_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::ROLE_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::PERMISSION_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::SETTINGS_MANAGEMENT_PERMISSIONS,
            PermissionsByActions::BANK_ACCOUNT_MANAGEMENT_PERMISSIONS
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
