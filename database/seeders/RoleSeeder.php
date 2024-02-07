<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleData = [
            [
                'role_name' => 'Administrator',
                'permission' => json_encode(
                    [
                        "dashboard" => [
                            "dashboard"
                        ],
                        "users" => [
                            "users",
                            "add_user"
                        ],
                        "roles" => [
                            "roles",
                            "add_role"
                        ],
                        "menus" => [
                            "menus",
                            "add_menu"
                        ],
                        "settings" => [
                            "configuration",
                            "integration"
                        ]
                    ]
                )
            ]
        ];
        DB::table('roles')->insert($roleData);
    }
}
