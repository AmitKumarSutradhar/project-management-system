<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectAndTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'name' => 'Project 1',
            ],
            [
                'name' => 'Project 2',
            ],
            [
                'name' => 'Project 3',
            ],
            [
                'name' => 'Project 4',
            ],
            [
                'name' => 'Project 5',
            ],
        ]);

        DB::table('tasks')->insert([
            [
                'title' => 'Task 1',
                'project_id' => 1,
                'created_by' => 1,
            ],
            [
                'title' => 'Task 2',
                'project_id' => 2,
                'created_by' => 3,
            ],
            [
                'title' => 'Task 3',
                'project_id' => 3,
                'created_by' => 2,
            ],
            [
                'title' => 'Task 4',
                'project_id' => 4,
                'created_by' => 1,
            ],
            [
                'title' => 'Task 5',
                'project_id' => 5,
                'created_by' => 4,
            ],
        ]);
    }
}
