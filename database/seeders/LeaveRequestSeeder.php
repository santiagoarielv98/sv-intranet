<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $vacation = LeaveType::where('name', 'Vacation')->first();
        $sick = LeaveType::where('name', 'Sick')->first();

        $employees = Employee::all();

        $employees->each(function ($employee) use ($vacation, $sick) {
            LeaveRequest::factory()->create([
                'employee_id' => $employee->id,
                'leave_type_id' => $vacation->id,
            ]);

            LeaveRequest::factory()->create([
                'employee_id' => $employee->id,
                'leave_type_id' => $sick->id,
            ]);
        });
    }
}
