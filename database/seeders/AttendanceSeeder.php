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

        // crear asistencia hasta 5 meses atras, para todos los empleados
        // lunes a viernes de 8 a 17
        $employees = Employee::all();
        $startDate = now()->subMonths(5);
        $endDate = now();

        foreach ($employees as $employee) {
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                if ($currentDate->isWeekday()) {
                    Attendance::factory()->create([
                        'employee_id' => $employee->id,
                        'check_in' => $currentDate->copy()->setHour(8)->setMinute(0)->setSecond(0),
                        'check_out' => $currentDate->copy()->setHour(17)->setMinute(0)->setSecond(0),
                    ]);
                }
                $currentDate->addDay();
            }
        }
    }
}
