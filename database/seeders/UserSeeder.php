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
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin@gmail.com'),
                'user_type' => 'admin',
            ],
            [
                'name' => 'Project Manager',
                'email' => 'projectmanager@gmail.com',
                'password' => Hash::make('projectmanager@gmail.com'),
                'user_type' => 'user',
            ],
            [
                'name' => 'Team Member',
                'email' => 'team.member@gmail.com',
                'password' => Hash::make('team.member@gmail.com'),
                'user_type' => 'user',
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user@gmail.com'),
                'user_type' => 'user',
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('user2@gmail.com'),
                'user_type' => 'user',
            ],
        ]);
    }
}
