<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PropertyTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->randomElement(['Flat', 'Detatched', 'Semi-detached', 'End of Terrace', 'Cottage', 'Terraced', 'Bungalow']),
            'description' => fake()->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
