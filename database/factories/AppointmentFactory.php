<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
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
            'purpose' => $this->faker->text(200),
            'is_approved' => $this->faker->boolean(50),
            'date' => $this->faker->date()
        ];
    }
}
