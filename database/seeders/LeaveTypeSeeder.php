<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        LeaveType::create(['name' => 'Vacation', 'max_days' => 15]);
        LeaveType::create(['name' => 'Sick', 'max_days' => 10]);
    }
}
