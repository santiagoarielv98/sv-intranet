<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'employee_id' => Employee::all()->random()->id,
            'leave_type_id' => LeaveType::all()->random()->id,
            'start_date' => now(),
            'end_date' => now()->addDays(1),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'comments' => $this->faker->sentence(),
        ];
    }
}
