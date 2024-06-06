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
            'assign driver',
            'create customer',
            'view customers',
            'show customer',
            'edit customer',
            'delete customer',
            'create organisation',
            'view organisation',
            'show organisation',
            'edit organisation',
            'delete organisation',
            'create driver',
            'show driver',
            'edit driver',
            'delete driver',
            'view bookings',
            'edit bookings',
            'delete bookings',
            'create route',
            'view routes',
            'show route',
            'edit route',
            'delete route',
            'view reports',
            'create trip',            
            'view trips',
            'show trip',
            'edit trip',
            'delete trip',
            'start trip',
            'end trip',
            'manage trips',
            'manage customers',
            'manage drivers',
            'manage orginisations',
            'manage vehicles',
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
            'show vehicle',
            'edit vehicle',
            'delete vehicle',
            'assign driver',
            'view drivers',
            'create customer',
            'view customers',
            'show customer',
            'edit customer',
            'delete customer',
            'create organisation',
            'view organisation',
            'show organisation',
            'edit organisation',
            'delete organisation',
            'create driver',
            'show driver',
            'edit driver',
            'delete driver',
            'view bookings',
            'edit bookings',
            'delete bookings',
            'create route',
            'view routes',
            'show route',
            'edit route',
            'delete route',
            'view reports',
            'create trip',
            'view trips',
            'show trip',
            'edit trip',
            'delete trip',
            'start trip',
            'end trip',
            'manage trips',
            'manage customers',
            'manage drivers',
            'manage orginisations',
            'manage vehicles',
        ]);

        $organisation->syncPermissions([
            'view vehicles',
            'create vehicles',
            'edit vehicle',
            'delete vehicle',
            'assign driver',
            'create driver',
            'view drivers',
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