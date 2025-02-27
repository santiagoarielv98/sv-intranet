<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\User;
use App\Models\Timesheet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nonSuperAdmin = User::withoutRole('super_admin')->get();
        $lastCalendar = Calendar::latest()->first();

        // registrar  todo un mes entero anterior hasta el día de hoy
        // horario tipico de trabajo (work) de 9 a 12 y de 14 a 18
        // horario de pausa (pause) de 12 a 14

        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now();

        foreach ($nonSuperAdmin as $user) {
            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                // Work from 9 to 12
                Timesheet::create([
                    'calendar_id' => $lastCalendar->id,
                    'user_id' => $user->id,
                    'type' => 'work',
                    'day_in' => $currentDate->copy()->setTime(9, 0),
                    'day_out' => $currentDate->copy()->setTime(12, 0),
                ]);

                // Pause from 12 to 14
                Timesheet::create([
                    'calendar_id' => $lastCalendar->id,
                    'user_id' => $user->id,
                    'type' => 'pause',
                    'day_in' => $currentDate->copy()->setTime(12, 0),
                    'day_out' => $currentDate->copy()->setTime(14, 0),
                ]);

                // Work from 14 to 18
                Timesheet::create([
                    'calendar_id' => $lastCalendar->id,
                    'user_id' => $user->id,
                    'type' => 'work',
                    'day_in' => $currentDate->copy()->setTime(14, 0),
                    'day_out' => $currentDate->copy()->setTime(18, 0),
                ]);

                $currentDate->addDay();
            }
        }
    }
}
