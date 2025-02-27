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
            'name' => 'Administración',
        ]);

        Department::create([
            'name' => 'Desarrollo',
        ]);
        Department::create([
            'name' => 'Ventas',
        ]);
        Department::create([
            'name' => 'Marketing',
        ]);
        Department::create([
            'name' => 'Recursos Humanos',
        ]);
        Department::create([
            'name' => 'Finanzas',
        ]);

        $nonSuperAdmin = User::withoutRole('super_admin')->get();

        Department::all()->each(function (Department $department) use ($nonSuperAdmin) {
            $department->users()->attach($nonSuperAdmin->random());
        });
    }
}
