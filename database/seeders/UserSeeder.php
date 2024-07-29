<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminData = [
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('123456'),
            'phone' => '0708373982',
            'address' => 'Nairobi, Kenya',
            'role' => 'admin',
        ];

        $organisationData = [
            'name' => 'SampleOrganisation',
            'email' => 'organisation@sample.com',
            'password' => bcrypt('123456'),
            'phone' => '0712345678',
            'address' => 'Nairobi, Kenya',
            'role' => 'organisation',
        ];

        $refuellingStationData = [
            'name' => 'SampleRefuellingStation',
            'email' => 'refuellingstation@sample.com',
            'password' => bcrypt('123456'),
            'phone' => '0787654321',
            'address' => 'Nairobi, Kenya',
            'role' => 'refuelling_station',
        ];

        $admin = User::create($adminData);
        $organisation = User::create($organisationData);
        $refuellingStation = User::create($refuellingStationData);

        $admin->assignRole('admin');
        $organisation->assignRole('organisation');
        $refuellingStation->assignRole('refuelling_station');
    }
}
