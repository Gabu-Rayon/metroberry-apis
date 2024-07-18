<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

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
            'fuelling_station',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $permissions = [
            // Settings Permissions
            'view settings',
            'create settings',
            'edit settings',
            'delete settings',
            'update settings',
            'manage settings',

            'view dashboard',
            'edit profile',
            'update profile',
            'delete profile',

            'manage users',
            'view user',
            'create user',
            'edit user',
            'delete user',
            'assign role',
            'assign permission',

            'manage customers',
            'view customers',
            'create customer',
            'edit customer',
            'delete customer',
            'activate customer',
            'deactivate customer',
            'update customer',
            'reset password',
            'edit password',
            'update password',
            'delete password',

            'manage organisations',
            'view organisations',
            'create organisation',
            'edit organisation',
            'delete organisation',
            'update organisation',

            // Drivers Permissions
            'manage drivers',
            'view drivers',
            'create driver',
            'edit driver',
            'delete driver',
            'update driver',
            'activate driver',
            'deactivate driver',
            'assign driver',
            'unassign driver',
            'view driver',
            'view driver trips',
            'view driver trips details',
            'delete driver trips details',
            'delete driver trips',
            'update driver trips details',
            'update driver trips',
            
            'manage drivers performances',
            'view driver performance',
            'create driver performance',
            'edit driver performance',
            'delete driver performance',
            'update driver performance',
            'view driver performance details',
            'create driver performance details',

            // License Permissions
            'manage driver licenses',
            'view driver licenses',
            'create driver license',
            'edit driver license',
            'verify driver license',
            'revoke driver license',
            'delete driver license',
            'update driver license',

            'manage driver license details',
            'view driver license details',
            'create driver license details',
            'edit driver license details',
            'delete driver license details',

            'manage psv badges',
            'view psv badges',
            'create psv badge',
            'edit psv badge',
            'delete psv badge',
            'update psv badge',

            'manage psv badge details',
            'view psv badge details',
            'create psv badge details',
            'edit psv badge details',
            'delete psv badge details',
            'update psv badge details',

            'verify psv badge',
            'revoke psv badge',

            'manage psv badge details',
            'view psv badge details',
            'create psv badge details',
            'edit psv badge details',
            'delete psv badge details',
            'update psv badge details',

            'manage routes',
            'view route',
            'create route',
            'edit route',
            'delete route',
            'update route',
            'view route details',
            'create route details',
            'edit route details',
            'delete route details',
            'update route details',
            'manage route details',

            'manage route locations',
            'view route location',
            'create route location',
            'edit route location',
            'delete route location',
            'update route location',

            'manage route location details',
            'view route location details',
            'create route location details',
            'edit route location details',
            'delete route location details',
            'update route location details',
            'manage route location details',

            'view trip',
            'create trip',
            'edit trip',
            'start trip',
            'end trip',
            'cancel trip',
            'delete trip',
            'update trip',
            'manage trips',
            'complete trip',
            'cancel trip',

            'view trip details',
            'create trip details',
            'edit trip details',
            'delete trip details',
            'update trip details',
            'manage trip details',

            'view vehicle',
            'create vehicle',
            'edit vehicle',
            'update vehicle',
            'delete vehicle',
            'manage vehicles',
            'assign vehicle',

            'view vehicle details',
            'create vehicle details',
            'edit vehicle details',
            'delete vehicle details',
            'update vehicle details',
            'manage vehicle details',

            'assign driver to vehicle',
            'reassign driver to vehicle',
            'unassign driver from vehicle',
            'manage driver assignments',
            'view driver assignments',
            'create driver assignment',
            'edit driver assignment',
            'delete driver assignment',
            'update driver assignment',
            'manage driver assignment details',
            
            'manage vehicles',
            'view vehicle details',
            'create vehicle details',
            'edit vehicle details',
            'delete vehicle details',
            'update vehicle details',
            'manage vehicle details',

            'activate vehicle',
            'deactivate vehicle',
            'view vehicle maintenance',
            'create vehicle maintenance',
            'edit vehicle maintenance',
            'delete vehicle maintenance',
            'update vehicle maintenance',
            'manage vehicle maintenance',

            // License Permissions
            'view driver license',
            'create driver license',
            'edit driver license',
            'delete driver license',
            'update driver license',
            'manage driver licenses',

            'view vehicle refueling',
            'create vehicle refueling',
            'edit vehicle refueling',
            'delete vehicle refueling',
            'update vehicle refueling',
            'manage vehicle refueling',

            'manage vehicle refueling details',
            'view vehicle refueling details',
            'create vehicle refueling details',
            'edit vehicle refueling details',
            'delete vehicle refueling details',
            'update vehicle refueling details',
            'manage vehicle refueling details',

            'view inventory expense',
            'create inventory expense',
            'edit inventory expense',
            'delete inventory expense',
            'update inventory expense',
            'manage inventory expense',

            'view inventory category',
            'create inventory category',
            'edit inventory category',
            'delete inventory category',
            'update inventory category',
            'manage inventory category',

            'view inventory location',
            'create inventory location',
            'edit inventory location',
            'delete inventory location',
            'update inventory location',
            'manage inventory location',

            'view inventory stock',
            'create inventory stock',
            'edit inventory stock',
            'delete inventory stock',
            'update inventory stock',
            'manage inventory stock',

            'view inventory parts',
            'create inventory parts',
            'edit inventory parts',
            'delete inventory parts',
            'update inventory parts',
            'manage inventory parts',

            'view inventory parts usage',
            'create inventory parts usage',
            'edit inventory parts usage',
            'delete inventory parts usage',
            'update inventory parts usage',
            'manage inventory parts usage',

            'view inventory vendors',
            'create inventory vendors',
            'edit inventory vendors',
            'delete inventory vendors',
            'update inventory vendors',
            'manage inventory vendors',

            'view inventory trip type',
            'create inventory trip type',
            'edit inventory trip type',
            'delete inventory trip type',
            'update inventory trip type',
            'manage inventory trip type',

            'view purchase',
            'create purchase',
            'edit purchase',
            'delete purchase',
            'update purchase',
            'manage purchase',

            'view report employee',
            'create report employee',
            'edit report employee',
            'delete report employee',
            'update report employee',
            'manage report employee',

            'view report driver',
            'create report driver',
            'edit report driver',
            'delete report driver',
            'update report driver',
            'manage report driver',

            'view report vehicle',
            'create report vehicle',
            'edit report vehicle',
            'delete report vehicle',
            'update report vehicle',
            'manage report vehicle',

            'view report trip',
            'create report trip',
            'edit report trip',
            'delete report trip',
            'update report trip',
            'manage report trip',

            'view report vehicle requisition',
            'create report vehicle requisition',
            'edit report vehicle requisition',
            'delete report vehicle requisition',
            'update report vehicle requisition',
            'manage report vehicle requisition',

            'view report pick drop requisition',
            'create report pick drop requisition',
            'edit report pick drop requisition',
            'delete report pick drop requisition',
            'update report pick drop requisition',
            'manage report pick drop requisition',

            'view report refuel requisition',
            'create report refuel requisition',
            'edit report refuel requisition',
            'delete report refuel requisition',
            'update report refuel requisition',
            'manage report refuel requisition',

            'view report purchase',
            'create report purchase',
            'edit report purchase',
            'delete report purchase',
            'update report purchase',
            'manage report purchase',

            'view report expense',
            'create report expense',
            'edit report expense',
            'delete report expense',
            'update report expense',
            'manage report expense',

            'view report maintenance',
            'create report maintenance',
            'edit report maintenance',
            'delete report maintenance',
            'update report maintenance',
            'manage report maintenance',

            'view permission',
            'create permission',
            'edit permission',
            'delete permission',
            'update permission',
            'manage permission',

            'view role',
            'create role',
            'edit role',
            'delete role',
            'update role',
            'manage role',

            'view vehicle insurance company',
            'create vehicle insurance company',
            'edit vehicle insurance company',
            'delete vehicle insurance company',
            'activate vehicle insurance company',
            'deactivate vehicle insurance company',
            'update vehicle insurance company',
            'manage vehicle insurance company',

            'view vehicle insurance',
            'create vehicle insurance',
            'edit vehicle insurance',
            'delete vehicle insurance',
            'update vehicle insurance',
            'manage vehicle insurance',

            'update profile',
            'reset password',
            'update avatar',
            'edit avatar',
            'delete avatar',
            'manage avatar',

            'manage profile',
            'view profile',
            'create profile',
            'edit profile',
            'delete profile',

            'view invoices',
            'create invoice',
            'edit invoice',
            'delete invoice',
            'show invoice',
            'manage invoice',

            'view user interface',
            'create user interface',
            'edit user interface',
            'delete user interface',
            'update user interface',
            'manage user interface',

        ];

        $settingsPermissions = [
            'view settings',
            'create settings',
            'edit settings',
            'delete settings',
            'update settings',
            'manage settings',
        ];

        $dashboardPermissions = [
            'view dashboard',
            'edit profile',
            'update profile',
            'delete profile',
        ];

        $employeePermissions = [
            'manage customers',
            'view customers',
            'create customer',
            'edit customer',
            'delete customer',
            'update customer',
            'activate customer',
            'deactivate customer',
        ];

        $organisationPermissions = [
            'manage organisations',
            'view organisations',
            'create organisation',
            'edit organisation',
            'delete organisation',
            'update organisation',
        ];

        $driversPermissions = [
            'manage drivers',
            'view drivers',
            'create driver',
            'edit driver',
            'delete driver',
            'update driver',
            'activate driver',
            'deactivate driver',
            'assign driver',
            'unassign driver',
        ];

        $licensePermissions = [
            'manage driver licenses',
            'view driver licenses',
            'create driver license',
            'edit driver license',
            'verify driver license',
            'revoke driver license',
            'delete driver license',
            'update driver license',

            'manage driver license details',
            'view driver license details',
            'create driver license details',
            'edit driver license details',
            'delete driver license details',
        ];

        $psv_badgePermissions = [
            'manage psv badges',
            'view psv badges',
            'create psv badge',
            'edit psv badge',
            'delete psv badge',
            'update psv badge',

            'manage psv badge details',
            'view psv badge details',
            'create psv badge details',
            'edit psv badge details',
            'delete psv badge details',
            'update psv badge details',
        ];

        $driver_performancePermissions = [
            'manage drivers performances',
            'view driver performance',
            'create driver performance',
            'edit driver performance',
            'delete driver performance',
            'update driver performance',
            'view driver performance details',
            'create driver performance details',
        ];

        $vehiclePermissions = [
            'view vehicle',
            'create vehicle',
            'edit vehicle',
            'update vehicle',
            'delete vehicle',
            'manage vehicles',
            'assign vehicle',
        ];

        $vehicle_insurancePermissions = [
            'view vehicle insurance',
            'create vehicle insurance',
            'edit vehicle insurance',
            'delete vehicle insurance',
            'update vehicle insurance',
            'manage vehicle insurance',
        ];

        $routePermissions = [
            'manage routes',
            'view route',
            'create route',
            'edit route',
            'delete route',
            'update route',
            'view route details',
            'create route details',
            'edit route details',
            'delete route details',
            'update route details',
            'manage route details',
        ];

        $route_locationPermissions = [
            'manage route locations',
            'view route location',
            'create route location',
            'edit route location',
            'delete route location',
            'update route location',
        ];

        $tripPermissions = [
            'view trip',
            'create trip',
            'edit trip',
            'start trip',
            'end trip',
            'cancel trip',
            'delete trip',
            'update trip',
            'manage trips',
            'complete trip',
            'cancel trip',
        ];

        $insurance_companyPermissions = [
            'view vehicle insurance company',
            'create vehicle insurance company',
            'edit vehicle insurance company',
            'delete vehicle insurance company',
            'activate vehicle insurance company',
            'deactivate vehicle insurance company',
            'update vehicle insurance company',
            'manage vehicle insurance company',
        ];

        $vehicle_maintenancePermissions = [
            'view vehicle maintenance',
            'create vehicle maintenance',
            'edit vehicle maintenance',
            'delete vehicle maintenance',
            'update vehicle maintenance',
            'manage vehicle maintenance',
        ];

        foreach($settingsPermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'settings'
            ]);
        }

        foreach($dashboardPermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'dashboard'
            ]);
        }

        foreach($organisationPermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'organisation'
            ]);
        }

        foreach($employeePermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'employee'
            ]);
        }

        foreach($driversPermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'drivers'
            ]);
        }

        foreach($licensePermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'license'
            ]);
        }

        foreach($psv_badgePermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'psv_badge'
            ]);
        }

        foreach($driver_performancePermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'driver_performance'
            ]);
        }

        foreach($vehiclePermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'vehicle'
            ]);
        }

        foreach($vehicle_insurancePermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'vehicle_insurance'
            ]);
        }

        foreach($routePermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'route'
            ]);
        }

        foreach($route_locationPermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'route_location'
            ]);
        }

        foreach($tripPermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'trip'
            ]);
        }

        foreach($insurance_companyPermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'insurance_company'
            ]);
        }

        foreach($vehicle_maintenancePermissions as $permission) {
            PermissionGroup::firstOrCreate([
                'permission_name' => $permission,
                'group_name' => 'vehicle_maintenance'
            ]);
        }



        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::where('name', 'admin')->first();
        $organisation = Role::where('name', 'organisation')->first();
        $customer = Role::where('name', 'customer')->first();
        $driver = Role::where('name', 'driver')->first();

        $admin->syncPermissions([
            // Dashboard Permissions
            'view dashboard',
            'edit profile',
            'update profile',
            'delete profile',

            'manage users',
            'view user',
            'create user',
            'edit user',
            'delete user',

            'assign role',
            'assign permission',
            'reset password',
            'edit password',
            'update password',
            'delete password',

            // Customer Permissions
            'manage customers',
            'view customers',
            'create customer',
            'edit customer',
            'delete customer',
            'update customer',
            'activate customer',
            'deactivate customer',

            // Organisation Permissions
            'manage organisations',
            'view organisations',
            'create organisation',
            'edit organisation',
            'delete organisation',
            'update organisation',

            // Drivers Permissions
            'manage drivers',
            'view drivers',
            'create driver',
            'edit driver',
            'delete driver',
            'update driver',
            
            'activate driver',
            'deactivate driver',
            'assign driver',
            'unassign driver',
            'view driver',
            'view driver trips',
            'view driver trips details',
            'delete driver trips details',
            'delete driver trips',
            'update driver trips details',
            'update driver trips',

            'manage drivers performances',
            'view driver performance',
            'create driver performance',
            'edit driver performance',
            'delete driver performance',
            'update driver performance',
            'view driver performance details',
            'create driver performance details',

            // License Permissions
            'manage driver licenses',
            'view driver licenses',
            'create driver license',
            'edit driver license',
            'verify driver license',
            'revoke driver license',
            'delete driver license',
            'update driver license',

            // License Details Permissions
            'manage driver license details',
            'view driver license details',
            'create driver license details',
            'edit driver license details',
            'delete driver license details',

            'manage psv badges',
            'view psv badges',
            'create psv badge',
            'edit psv badge',
            'delete psv badge',
            'update psv badge',

            'manage psv badge details',
            'view psv badge details',
            'create psv badge details',
            'edit psv badge details',
            'delete psv badge details',
            'update psv badge details',


            'verify psv badge',
            'revoke psv badge',

            'manage psv badge details',
            'view psv badge details',
            'create psv badge details',
            'edit psv badge details',
            'delete psv badge details',
            'update psv badge details',

            'manage routes',
            'view route',
            'create route',
            'edit route',
            'delete route',
            'update route',
            'view route details',
            'create route details',
            'edit route details',
            'delete route details',
            'update route details',
            'manage route details',

            'manage route locations',
            'view route location',
            'create route location',
            'edit route location',
            'delete route location',
            'update route location',

            'manage route location details',
            'view route location details',
            'create route location details',
            'edit route location details',
            'delete route location details',
            'update route location details',
            'manage route location details',

            'view trip',
            'create trip',
            'edit trip',
            'delete trip',
            'update trip',
            'manage trips',
            'complete trip',
            'cancel trip',

            'view trip details',
            'create trip details',
            'edit trip details',
            'delete trip details',
            'update trip details',
            'manage trip details',

            'view vehicle',
            'create vehicle',
            'edit vehicle',
            'update vehicle',
            'delete vehicle',
            'manage vehicles',
            'assign vehicle',

            'view vehicle details',
            'create vehicle details',
            'edit vehicle details',
            'delete vehicle details',
            'update vehicle details',
            'manage vehicle details',

            'assign driver to vehicle',
            'reassign driver to vehicle',
            'unassign driver from vehicle',
            'manage driver assignments',
            'view driver assignments',
            'create driver assignment',
            'edit driver assignment',
            'delete driver assignment',
            'update driver assignment',
            'manage driver assignment details',


            'manage vehicles',
            'view vehicle details',
            'create vehicle details',
            'edit vehicle details',
            'delete vehicle details',
            'update vehicle details',
            'manage vehicle details',

            'activate vehicle',
            'deactivate vehicle',
            'view vehicle maintenance',
            'create vehicle maintenance',
            'edit vehicle maintenance',
            'delete vehicle maintenance',
            'update vehicle maintenance',
            'manage vehicle maintenance',

            // License Permissions
            'view driver license',
            'create driver license',
            'edit driver license',
            'delete driver license',
            'update driver license',
            'manage driver licenses',

            'view vehicle refueling',
            'create vehicle refueling',
            'edit vehicle refueling',
            'delete vehicle refueling',
            'update vehicle refueling',
            'manage vehicle refueling',

            'manage vehicle refueling details',
            'view vehicle refueling details',
            'create vehicle refueling details',
            'edit vehicle refueling details',
            'delete vehicle refueling details',
            'update vehicle refueling details',
            'manage vehicle refueling details',

            'view inventory expense',
            'create inventory expense',
            'edit inventory expense',
            'delete inventory expense',
            'update inventory expense',
            'manage inventory expense',

            'view inventory category',
            'create inventory category',
            'edit inventory category',
            'delete inventory category',
            'update inventory category',
            'manage inventory category',

            'view inventory location',
            'create inventory location',
            'edit inventory location',
            'delete inventory location',
            'update inventory location',
            'manage inventory location',

            'view inventory stock',
            'create inventory stock',
            'edit inventory stock',
            'delete inventory stock',
            'update inventory stock',
            'manage inventory stock',

            'view inventory parts',
            'create inventory parts',
            'edit inventory parts',
            'delete inventory parts',
            'update inventory parts',
            'manage inventory parts',

            'view inventory parts usage',
            'create inventory parts usage',
            'edit inventory parts usage',
            'delete inventory parts usage',
            'update inventory parts usage',
            'manage inventory parts usage',

            'view inventory vendors',
            'create inventory vendors',
            'edit inventory vendors',
            'delete inventory vendors',
            'update inventory vendors',
            'manage inventory vendors',

            'view inventory trip type',
            'create inventory trip type',
            'edit inventory trip type',
            'delete inventory trip type',
            'update inventory trip type',
            'manage inventory trip type',

            'view purchase',
            'create purchase',
            'edit purchase',
            'delete purchase',
            'update purchase',
            'manage purchase',

            'view report employee',
            'create report employee',
            'edit report employee',
            'delete report employee',
            'update report employee',
            'manage report employee',

            'view report driver',
            'create report driver',
            'edit report driver',
            'delete report driver',
            'update report driver',
            'manage report driver',

            'view report vehicle',
            'create report vehicle',
            'edit report vehicle',
            'delete report vehicle',
            'update report vehicle',
            'manage report vehicle',

            'view report trip',
            'create report trip',
            'edit report trip',
            'delete report trip',
            'update report trip',
            'manage report trip',

            'view report vehicle requisition',
            'create report vehicle requisition',
            'edit report vehicle requisition',
            'delete report vehicle requisition',
            'update report vehicle requisition',
            'manage report vehicle requisition',

            'view report pick drop requisition',
            'create report pick drop requisition',
            'edit report pick drop requisition',
            'delete report pick drop requisition',
            'update report pick drop requisition',
            'manage report pick drop requisition',

            'view report refuel requisition',
            'create report refuel requisition',
            'edit report refuel requisition',
            'delete report refuel requisition',
            'update report refuel requisition',
            'manage report refuel requisition',

            'view report purchase',
            'create report purchase',
            'edit report purchase',
            'delete report purchase',
            'update report purchase',
            'manage report purchase',

            'view report expense',
            'create report expense',
            'edit report expense',
            'delete report expense',
            'update report expense',
            'manage report expense',

            'view report maintenance',
            'create report maintenance',
            'edit report maintenance',
            'delete report maintenance',
            'update report maintenance',
            'manage report maintenance',

            'view settings',
            'create settings',
            'edit settings',
            'delete settings',
            'update settings',
            'manage settings',

            'view permission',
            'create permission',
            'edit permission',
            'delete permission',
            'update permission',
            'manage permission',

            'view role',
            'create role',
            'edit role',
            'delete role',
            'update role',
            'manage role',

            'view vehicle insurance company',
            'create vehicle insurance company',
            'edit vehicle insurance company',
            'delete vehicle insurance company',
            'activate vehicle insurance company',
            'deactivate vehicle insurance company',            
            'update vehicle insurance company',
            'manage vehicle insurance company',


            'view vehicle insurance',
            'create vehicle insurance',
            'edit vehicle insurance',
            'delete vehicle insurance',
            'update vehicle insurance',
            'manage vehicle insurance',

            'view user interface',
            'create user interface',
            'edit user interface',
            'delete user interface',
            'update user interface',
            'manage user interface',

        ]);

        $organisation->syncPermissions([
            'view dashboard',
            'edit profile',
            'update profile',

            'manage users',
            'view user',
            'create user',
            'edit user',
            'assign role',
            'assign permission',

            'manage customers',
            'view customers',
            'create customer',
            'edit customer',
            'update customer',

            'reset password',
            'edit password',
            'update password',

            'view trip details',
            'create trip details',
            'edit trip details',
            'update trip details',
            'manage trip details',

            'view trip',
            'create trip',
            'edit trip',
            'start trip',
            'end trip',
            'cancel trip',
            'update trip',
            'manage trips',

            'view trip details',
            'create trip details',
            'edit trip details',
            'delete trip details',
            'update trip details',
            'manage trip details',

            'view vehicle',
            'create vehicle',
            'edit vehicle',
            'update vehicle',
            'manage vehicles',

            // Drivers Permissions
            'manage drivers',
            'view drivers',
            'create driver',
            'edit driver',
            'update driver',

            'view vehicle details',
            'create vehicle details',
            'edit vehicle details',
            'update vehicle details',
            'manage vehicle details',

            'view settings',
            'create settings',
            'edit settings',
            'delete settings',
            'update settings',
            'manage settings',

            'view permission',
            'create permission',
            'edit permission',
            'delete permission',
            'update permission',
            'manage permission',

            'view vehicle insurance',
            'create vehicle insurance',
            'edit vehicle insurance',
            'update vehicle insurance',
            'manage vehicle insurance',

            'view role',
            'create role',
            'edit role',
            'delete role',
            'update role',
            'manage role',

            'view vehicle insurance company',
            'create vehicle insurance company',
            'edit vehicle insurance company',
            'update vehicle insurance company',
            'manage vehicle insurance company',


            'view user interface',
            'create user interface',
            'edit user interface',
            'update user interface',
            'manage user interface',
        ]);

        $customer->syncPermissions([
            'view trip',
            'create trip',
            'edit trip',
            'start trip',
            'end trip',
            'cancel trip',
            'delete trip',
            'update trip',
            'manage trips',
            
            'view route',
            'update profile',
            'reset password',
            'edit password',
            'update password',
            'delete password',

            'edit avatar',
            'update avatar',
            'delete avatar',
            'manage avatar',

            'manage profile',
            'view profile',
            'create profile',
            'edit profile',
            'delete profile',

            'view invoices',
            'create invoice',
            'edit invoice',
            'delete invoice',
            'show invoice',

        ]);

        $driver->syncPermissions([
            'view vehicle',
            'create vehicle',
            'edit vehicle',
            'delete vehicle',
            'update vehicle',

            'start trip',
            'end trip',
            'cancel trip',
            'view trip',

            'update profile',
            'reset password',
            'edit password',
            'update password',
            'delete password',
            'edit avatar',
            'update avatar',
            'delete avatar',
            'manage avatar',

            'manage profile',
            'view profile',
            'create profile',
            'edit profile',
            'delete profile',
        ]);
    }
}