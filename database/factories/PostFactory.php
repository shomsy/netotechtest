<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['topic' => "string"])] public function definition(): array
    {
        return [
            'topic' => $this->faker->unique()->word()
        ];
    }
}
