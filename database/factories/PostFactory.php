<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,2),
            'subject_id' => rand(1,3),
            'name'  => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence()) . Str::random(6),
            'body' => $this->faker->paragraph(15)
        ];
    }
}
