<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'project_manager']);
        $memberRole = Role::create(['name' => 'team_member']);

        // Assign roles to users (example)
        $admin = User::find(1); // Assuming user with ID 1 is the admin
        $admin->assignRole($adminRole);

        $manager = User::find(2); // Assuming user with ID 2 is a project manager
        $manager->assignRole($managerRole);

        $member = User::find(3); // Assuming user with ID 3 is a team member
        $member->assignRole($memberRole);
    }
}
