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
            DepartmentSeeder::class,
        ]);

        $demo =User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
        ]);

        $demo->assignRole('panel_user');

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $admin->assignRole('super_admin');

        User::factory(10)->create();

        Calendar::create([
            'name' => 'Demo Calendar ' . now()->year,
            'year' => now()->year,
            'active' => true,
        ]);

        $this->call([
            HolidaySeeder::class,
        ]);
    }
}
