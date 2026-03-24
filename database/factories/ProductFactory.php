<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $price = $this->faker->randomFloat(2, 10, 100000);

        return [
            'name' => $this->faker->words(5, true),
            'price' => $price,
            'sale_price' => $this->faker->boolean(40) ? $this->faker->randomFloat(2, 0, $price) : null,
            'stock' => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->optional()->paragraph(),
            'image' => $this->faker->optional()->imageUrl(),
            'is_active' => $this->faker->boolean(90),
            'is_delete' => false,
        ];
    }
}