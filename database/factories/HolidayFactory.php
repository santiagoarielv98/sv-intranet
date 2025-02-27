<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Holiday>
 */
class HolidayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'calendar_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'day' => $this->faker->dateTimeBetween(),
            'type' => $this->faker->randomElement(['decline', 'approved', 'pending']),
        ];
    }
}
