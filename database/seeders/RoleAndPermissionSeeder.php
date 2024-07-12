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

            // Organisation Permissions
            'view organisations',
            'create organisation',
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

            // User Permissions
            'manage users',

            // Employee Permissions
            'view customers',
            'create customer',

            // Organisation Permissions
            'view organisations',
            'create organisation'
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
        ]);

        $driver->syncPermissions([
        ]);
    }
}