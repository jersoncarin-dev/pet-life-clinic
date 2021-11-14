<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'price' => $this->faker->numberBetween(10,99),
            'is_available' => $this->faker->boolean(60),
            'thumbnail' => $this->faker->imageUrl(),
            'description' => $this->faker->text(100)
        ];
    }
}
