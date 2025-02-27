<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ShieldSeeder::class,
            WorldTableSeeder::class,
        ]);

        $address = [
            'country_id' => 11, // Argentina
            'state_id' => 3656, // Buenos Aires
            'city_id' => 704, // Buenos Aires
            'address' => 'Av. Corrientes 1234',
            'postal_code' => '1043',
        ];

        User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            ...$address,
        ])->assignRole('panel_user');

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            ...$address,
        ])->assignRole('super_admin');

        User::factory(10)->create();

        Calendar::create([
            'name' => 'Demo Calendar ' . now()->year,
            'year' => now()->year,
            'active' => true,
        ]);

        $this->call([
            HolidaySeeder::class,
            DepartmentSeeder::class,
            TimesheetSeeder::class,
        ]);
    }
}
