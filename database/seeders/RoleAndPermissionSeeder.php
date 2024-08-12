<?php

namespace Database\Seeders;

use App\Models\User;
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
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'project']);
        Permission::create(['name' => 'task']);
        Permission::create(['name' => 'comment']);
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'update-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'create-project']);
        Permission::create(['name' => 'edit-project']);
        Permission::create(['name' => 'update-project']);
        Permission::create(['name' => 'delete-project']);
        Permission::create(['name' => 'create-task']);
        Permission::create(['name' => 'edit-task']);
        Permission::create(['name' => 'update-task']);
        Permission::create(['name' => 'delete-task']);
        Permission::create(['name' => 'create-comment']);
        Permission::create(['name' => 'edit-comment']);
        Permission::create(['name' => 'update-comment']);
        Permission::create(['name' => 'delete-comment']);

        $adminRole = Role::create(['name' => 'Admin']);
        $projectManagerRole = Role::create(['name' => 'Project Manager']);
        $teamMemberRole = Role::create(['name' => 'Team Member']);
        $userRole = Role::create(['name' => 'User']);

        $adminRole->givePermissionTo([
            'users',
            'project',
            'task',
            'comment',
            'create-users',
            'edit-users',
            'update-users',
            'delete-users',
            'create-project',
            'edit-project',
            'update-project',
            'delete-project',
            'create-task',
            'edit-task',
            'update-task',
            'delete-task',
            'create-comment',
            'edit-comment',
            'update-comment',
            'delete-comment',
        ]);

        $projectManagerRole->givePermissionTo([
            'project',
            'task',
            'comment',
            'edit-project',
            'update-project',
            'create-task',
            'edit-task',
            'update-task',
            'delete-task',
            'create-comment',
            'edit-comment',
            'update-comment',
            'delete-comment',
        ]);

        $teamMemberRole->givePermissionTo([
            'task',
            'comment',
            'edit-task',
            'update-task',
            'create-comment',
            'edit-comment',
            'update-comment',
            'delete-comment',
        ]);

    }
}
