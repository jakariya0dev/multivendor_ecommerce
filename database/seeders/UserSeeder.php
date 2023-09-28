<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            [
                'name' => 'Admin Zakaria',
                'user_name' => 'admin',
                'email' => 'admin@mail.com',
                'mobile' => '01762940480',
                'address' => 'CO road, Badarganj',
                'role' => 'admin',
                'status' => 'active',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Vendor Zakaria',
                'user_name' => 'vendor',
                'email' => 'vendor@mail.com',
                'mobile' => '01762940481',
                'address' => 'CO road, Badarganj',
                'role' => 'vendor',
                'status' => 'active',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'User Zakaria',
                'user_name' => 'user',
                'email' => 'user@mail.com',
                'mobile' => '01762940482',
                'address' => 'CO road, Badarganj',
                'role' => 'user',
                'status' => 'active',
                'password' => Hash::make('123456')
            ]
        ]);
    }
}
