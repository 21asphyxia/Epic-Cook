<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "path" => $this->faker->imageUrl(640, 480, 'food', true),
            "created_at" => $this->faker->dateTimeBetween('-1 year', 'now'),
            "updated_at" => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
