<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configData = [
            [
                'group' => 'General',
                'name' => 'app_name',
                'value' => 'Laravel Starter Kit',
                'type' => 'string'
            ],
            [
                'group' => 'General',
                'name' => 'admin_page_title',
                'value' => 'Administrator',
                'type' => 'string'
            ]
        ];
        DB::table('configuration')->insert($configData);
    }
}
