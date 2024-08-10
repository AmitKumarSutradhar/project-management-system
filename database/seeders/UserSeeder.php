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
                'role' => 'admin',
            ],
            [
                'name' => 'Project Manager',
                'email' => 'projectmanager@gmail.com',
                'password' => Hash::make('projectmanager@gmail.com'),
                'role' => 'project_manager',
            ],
            [
                'name' => 'Team Member',
                'email' => 'team.member@gmail.com',
                'password' => Hash::make('team.member@gmail.com'),
                'role' => 'team_member',
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user@gmail.com'),
                'role' => 'user',
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('user2@gmail.com'),
                'role' => 'user',
            ],
        ]);
    }
}
