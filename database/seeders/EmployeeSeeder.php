<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Employee::factory()->count(50)->create([
            // 'position_id' => Position::all()->random()->id,
            'country_id' => 11,
            'state_id' => 3656,
            'city_id' => 704,
        ]);
    }
}
