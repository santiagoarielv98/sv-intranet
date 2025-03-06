<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
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
            'document_type' => $this->faker->randomElement(['CV', 'contract', 'id_card', 'other']),
            'file_path' => $this->faker->imageUrl(),
        ];
    }
}
