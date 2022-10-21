<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => fake()->uuid(),
            'property_type_id' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7]),
            'county' => fake()->city(),
            'country' => fake()->country(),
            'town' => fake()->city(),
            'description' => fake()->text(),
            'address' => fake()->address(),
            'image_full' => fake()->imageUrl(),
            'image_thumbnail' => fake()->imageUrl(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'num_bedrooms' => fake()->numberBetween(1, 6),
            'num_bathrooms' => fake()->numberBetween(1, 5),
            'price' => fake()->numberBetween(75058, 2999832),
            'type' => fake()->randomElement(['rent', 'sale']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
