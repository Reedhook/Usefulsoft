<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name'=>fake()->name,
            'price_per_day'=>fake()->numberBetween(100,600),
            'price_per_week'=>fake()->numberBetween(1000,1500)
        ];
    }
}
