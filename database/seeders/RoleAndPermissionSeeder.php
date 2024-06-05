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
            'view vehicles',
            'create vehicles',
            'show vehicle',
            'edit vehicle',
            'delete vehicle',
            'create customer',
            'create organisation',
            'create driver',
            'create route',
            'view routes',
            'create trip',
            'view trips',
            'start trip',
            'end trip',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::where('name', 'admin')->first();
        $organisation = Role::where('name', 'organisation')->first();
        $customer = Role::where('name', 'customer')->first();
        $driver = Role::where('name', 'driver')->first();

        $admin->syncPermissions([
            'view vehicles',
            'create vehicles',
            'edit vehicle',
            'delete vehicle',
            'create customer',
            'create organisation',
            'create driver',
            'create route',
            'view routes',
            'create trip',
            'view trips',
            'start trip',
            'end trip',
            'view organisations',
        ]);

        $organisation->syncPermissions([
            'view vehicles',
            'create vehicles',
            'edit vehicle',
            'delete vehicle',
            'create driver',
            'create route',
            'view routes',
            'create trip',
            'view trips',
            'start trip',
            'end trip',
        ]);

        $customer->syncPermissions([
            'view routes',
            'create trip',
            'view trips',
        ]);

        $driver->syncPermissions([
            'show vehicle',
            'start trip',
            'end trip',
        ]);
    }
}