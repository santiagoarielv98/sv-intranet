<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $employees = Employee::all();

        foreach ($employees as $employee) {
            $user = User::factory()->create([
                'name' => $employee->full_name,
                'email' => $employee->email,
            ]);

            $user->assignRole('panel_user');
        }
    }
}
