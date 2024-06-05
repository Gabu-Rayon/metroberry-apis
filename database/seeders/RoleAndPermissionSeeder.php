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
    public function run(): void {

        $admin = Role::create(['name' => 'admin']);
        $organisation = Role::create(['name' => 'organisation']);
        $customer = Role::create(['name' => 'customer']);
        $driver = Role::create(['name' => 'driver']);

        $permissions = [
            'view vehicles',
            'create vehicles',
            'show vehicle',
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
            Permission::create(['name' => $permission]);
        }

        $admin->givePermissionTo([
            'view vehicles',
            'create vehicles',
            'create customer',
            'create organisation',
            'create driver',
            'create route',
            'view routes',
            'create trip',
            'view trips',
            'start trip',
            'end trip',
        ]);

        $organisation->givePermissionTo([
            'view vehicles',
            'create vehicles',
            'create driver',
            'create route',
            'view routes',
            'create trip',
            'view trips',
            'start trip',
            'end trip',
        ]);

        $customer->givePermissionTo([
            'view routes',
            'create trip',
            'view trips',
        ]);

        $driver->givePermissionTo([
            'show vehicle',
            'start trip',
            'end trip',
        ]);
    }
}
