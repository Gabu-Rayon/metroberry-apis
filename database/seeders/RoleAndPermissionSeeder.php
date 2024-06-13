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
            'view routes',
            'create route',
            'edit route',
            'delete route',
            'show route',
            'view dashboard',

            'view vehicles',
            'create vehicle',
            'edit vehicle',
            'delete vehicle',
            'show vehicle',

           'view invoices',
            'create invoice',
            'edit invoice',
            'delete invoice',
            'show invoice',

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

            'view customers',
            'create customer',
            'edit customer',
            'delete customer',
            'show customer',

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
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::where('name', 'admin')->first();
        $organisation = Role::where('name', 'organisation')->first();
        $customer = Role::where('name', 'customer')->first();
        $driver = Role::where('name', 'driver')->first();

        $admin->syncPermissions([
            'view routes',
            'create route',
            'edit route',
            'delete route',
            'show route',
            'view dashboard',

            'view vehicles',
            'create vehicle',
            'edit vehicle',
            'delete vehicle',
            'show vehicle',

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

            'view customers',
            'create customer',
            'edit customer',
            'delete customer',
            'show customer',

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
            
        ]);

        $organisation->syncPermissions([
            'view vehicles',
            'create vehicle',
            'edit vehicle',
            'delete vehicle',
            'show vehicle',
            'view dashboard',

            'view drivers',
            'create driver',
            'edit driver',
            'delete driver',
            'show driver',
            'assign driver',

            'view customers',
            'create customer',
            'edit customer',
            'delete customer',
            'show customer',

            'view routes',
            'create route',
            'edit route',
            'delete route',
            'show route',

             'view invoices',
            'create invoice',
            'edit invoice',
            'delete invoice',
            'show invoice',

            'view trips',
            'create trip',
            'edit trip',
            'delete trip',
            'show trip',
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
        ]);
    }
}