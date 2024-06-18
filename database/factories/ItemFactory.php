<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'warehouse_id' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
            'serial_number' => fake()->randomNumber(9, true),
            'owner' => fake()->randomElement(['tsel', 'ebis']),
            'item_description_id' => fake()->numberBetween(1, 30),
            'status' => 'available',
            'note' => 'ready to use'
        ];
    }
}
