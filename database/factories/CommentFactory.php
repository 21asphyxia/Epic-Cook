<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "content" => $this->faker->text(100),
            "user_id" => $this->faker->numberBetween(1, 10),
            "created_at" => $this->faker->dateTimeBetween('-2 year', '-1 year'),
            "updated_at" => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
