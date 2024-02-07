<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'username' => 'Admin',
                'email' => 'admin@example.com',
                'address' => '',
                'phone' => '08124564236',
                'password' => Hash::make('Password123!'),
                'role_id' => 1,
                'status' => true
            ]
        ];
        DB::table('users')->insert($userData);
    }
}
