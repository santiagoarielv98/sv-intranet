<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'country_id' => $this->faker->numberBetween(1, 100),
            'state_id' => $this->faker->numberBetween(1, 100),
            'city_id' => $this->faker->numberBetween(1, 100),
            'hire_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'position_id' => $this->faker->numberBetween(1, 100),
            'salary' => $this->faker->numberBetween(1000000, 3500000),
            'status' => $this->faker->randomElement(['active', 'inactive', 'on_leave']),
        ];
    }
}
