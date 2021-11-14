<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class ReminderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->text(20),
            'body' => $this->faker->text(50),
            'is_read' => $this->faker->boolean(60),
            'link' => Str::slug($this->faker->name)
        ];
    }
}
