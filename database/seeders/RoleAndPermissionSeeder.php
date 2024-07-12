<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'organisation',
            'customer',
            'driver'
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $permissions = [
            // Dashboard Permissions
            'view dashboard',

            // User Permissions
            'manage users',

            // Employee Permissions
            'view customers',
            'create customer',

            'view trips',
            'create trip',
            'edit trip',
            'delete trip',
            'show trip',

            'start trip',
            'end trip',

            'view vehicles',
            'create vehicles',
            'show vehicle',
            'edit vehicle',
            'delete vehicle',
            'deactivate vehicle',

            'assign driver',
            'view drivers',
            'activate driver',
            'deactivate driver',

            'show customer',
            'edit customer',
            'delete customer',
            'create organisation',
            'view organisation',
            'show organisation',
            'edit organisation',
            'delete organisation',

            'manage trips',
            'manage drivers',
            'manage orginisations',
            'manage vehicles',
            'manage trips',
            'book trip',

            'update profile',
            'reset password',
            'update avatar',
            'view dashboard',

            'manage insurance company',
            'edit insurance company',
            'delete insurance company',
            'view insurance company',
            'activate insurance company',
            'deactivate insurance company',

            'manage insurance recurring period',
            'edit insurance recurring period',
            'delete insurance recurring period',
            'view insurance recurring period',
            'activate insurance recurring period',
            'deactivate insurance recurring period',

            'manage vehicle refueling',
            'edit vehicle refueling',
            'delete vehicle refueling',
            'view vehicle refueling',

            'manage reports',
            'edit report',
            'delete report',
            'view report',
            'create report',

            'manage purchase',
            'edit purchase',
            'delete purchase',
            'view purchase',
            'create purchase',

            'manage settings',
            'edit setting',
            'delete setting',
            'view setting',
            'create setting',


            'manage permissions',
            'edit permission',
            'delete permission',
            'view permission',
            'create permission',

            'manage roles',
            'edit role',
            'delete role',
            'view role',
            'create role',
        ];

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

            'view vehicles',
            'create vehicle',
            'edit vehicle',
            'delete vehicle',
            'show vehicle',
            'deactivate vehicle',

            'view organisations',
            'create organisation',
            'edit organisation',
            'delete organisations',
            'show organisations',

            'view drivers',
            'create driver',
            'edit driver',
            'delete driver',
            'show driver',
            'assign driver',
            'activate driver',
            'deactivate driver',

            // Employee Permissions
            'view customers',
            'create customer',

            'view trips',
            'create trip',
            'edit trip',
            'delete trip',
            'show trip',

            'start trip',
            'end trip',

            'view invoices',
            'create invoice',
            'edit invoice',
            'delete invoice',
            'show invoice',
            'view vehicles',
            'create vehicles',
            'show vehicle',
            'edit vehicle',
            'delete vehicle',
            'assign driver',
            'view drivers',
            'show customer',
            'edit customer',
            'delete customer',
            'create organisation',
            'view organisation',
            'show organisation',
            'edit organisation',
            'delete organisation',           

            'manage trips',
            'manage drivers',
            'manage orginisations',
            'manage vehicles',
            'manage trips',
            'book trip',

            'update profile',
            'reset password',
            'update avatar',



            'manage insurance company',
            'edit insurance company',
            'delete insurance company',
            'view insurance company',
            'activate insurance company',
            'deactivate insurance company',

            'manage insurance recurring period',
            'edit insurance recurring period',
            'delete insurance recurring period',
            'view insurance recurring period',
            'activate insurance recurring period',
            'deactivate insurance recurring period',

            'manage vehicle refueling',
            'edit vehicle refueling',
            'delete vehicle refueling',
            'view vehicle refueling',

            'manage reports',
            'edit report',
            'delete report',
            'view report',
            'create report',

            'manage purchase',
            'edit purchase',
            'delete purchase',
            'view purchase',
            'create purchase',

            'manage settings',
            'edit setting',
            'delete setting',
            'view setting',
            'create setting',


            'manage permissions',
            'edit permission',
            'delete permission',
            'view permission',
            'create permission',

            'manage roles',
            'edit role',
            'delete role',
            'view role',
            'create role',
            
        ]);

        $organisation->syncPermissions([
            // Dashboard Permissions
            'view dashboard',
            
            // User Permissions
            'manage users',

            // Employee Permissions
            'view customers',
        ]);

        $customer->syncPermissions([
            'create trip',
            'edit trip',
            'delete trip',
            'show trip',
            'view routes',
            'update profile',
            'reset password',
            'update avatar',

            'view invoices',
            'create invoice',
            'edit invoice',
            'delete invoice',
            'show invoice',
        ]);

        $driver->syncPermissions([
            'show vehicle',
            'start trip',
            'end trip',
            'update profile',
            'reset password',
            'update avatar',
        ]);
    }
}