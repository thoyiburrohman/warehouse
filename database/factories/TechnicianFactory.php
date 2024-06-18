<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technician>
 */
class TechnicianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->numberBetween(200000, 299999),
            'name' => fake()->name(),
            'division' => fake()->randomElement(['psb cons', 'ass cons', 'psb bges', 'ass bges', 'migrasi']),
            'mitra_id' => 1,

        ];
    }
}
