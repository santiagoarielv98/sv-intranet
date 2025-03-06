<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::all()->random()->id,
            'check_in' => $this->faker->dateTimeThisMonth(),
            'check_out' => $this->faker->dateTimeThisMonth(),
            'location' => "{$this->faker->latitude}, {$this->faker->longitude}",
            'ip_address' => $this->faker->ipv4,
        ];
    }
}
