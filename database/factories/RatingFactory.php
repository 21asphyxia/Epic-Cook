<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "rating_number" => $this->faker->numberBetween(1, 5),
            "user_id" => $this->faker->numberBetween(1, 10),
            "created_at" => $this->faker->dateTimeBetween('-1 year', 'now'),
            "updated_at" => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
