<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'Marketing',
            'description' => 'Marketing Department',
        ]);

        Department::create([
            'name' => 'Sales',
            'description' => 'Sales Department',
        ]);

        Department::create([
            'name' => 'Finance',
            'description' => 'Finance Department',
        ]);

        Department::create([
            'name' => 'Human Resources',
            'description' => 'Human Resources Department',
        ]);

        Department::create([
            'name' => 'IT',
            'description' => 'IT Department',
        ]);

        Department::create([
            'name' => 'Customer Service',
            'description' => 'Customer Service Department',
        ]);

        Department::create([
            'name' => 'Production',
            'description' => 'Production Department',
        ]);
    }
}
