<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all(); // 50
        $startDate = now()->subMonths(5);
        $endDate = now();

        $attendances = [];

        foreach ($employees as $employee) {
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                if ($currentDate->isWeekday()) {
                    $attendances[] = [
                        'employee_id' => $employee->id,
                        'check_in' => $currentDate->copy()->setHour(8)->setMinute(0)->setSecond(0),
                        'check_out' => $currentDate->copy()->setHour(17)->setMinute(0)->setSecond(0),
                        'location' => '40.7128, -74.0060',
                        'ip_address' => '127.0.0.1',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $currentDate->addDay();
            }
        }

        Attendance::insert($attendances);
    }
}
