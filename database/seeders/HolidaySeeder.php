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
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-01-01',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-01-06',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-04-15',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-04-18',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-05-01',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-06-24',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-09-08',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-10-12',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-11-01',
                'type' => 'Public',
            ],
            [
                'calendar_id' => $lastCalendar->id,
                'user_id' => $nonSuperAdmin->random()->id,
                'day' => '2022-12-06',
                'type' => 'Public',
            ],
        ];

        foreach ($holidays as $holiday) {
            Holiday::create($holiday);
        }

    }
}
