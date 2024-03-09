<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        return [
            'code' => fake()->ean8(),
            'name' => fake()->name(),
            'price_ex_vat' => fake()->randomFloat(2, 0, 10),
            'price_inc_vat' => fake()->randomFloat(2, 0, 10),
            'stock' => fake()->numberBetween(0, 100),
            'short_description' => fake()->text(100),
        ];
    }
}
