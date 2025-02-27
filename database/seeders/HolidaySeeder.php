<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\Holiday;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $nonSuperAdmin = User::withoutRole('super_admin')->get();
        $lastCalendar = Calendar::orderBy('id', 'desc')->first();

        $holidays = [
            [
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-01-01'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-01-06'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-04-15'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-04-18'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-05-01'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-06-24'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-09-08'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-10-12'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-11-01'
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-12-06'
            ],
        ];

        foreach ($holidays as $holiday) {
            Holiday::factory()->create($holiday);
        }

    }
}
