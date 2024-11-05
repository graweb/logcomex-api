<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rand = rand(1, 1000);
        return [
            'code' => Str::random(10),
            'name' => 'Produto ' . $rand,
            'description' => 'Descrição do produto ' . $rand,
            'quantity' => rand(1, 1000),
            'minimum_quantity' => rand(1, 100),
            'amount' => fake()->randomFloat(2, 1, 100),
            'country' => fake()->country(),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
