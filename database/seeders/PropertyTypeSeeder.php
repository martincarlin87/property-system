<?php

namespace Database\Seeders;


use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyType::factory()->create(
            [
                'id' => 1,
                'title' => 'Flat',
            ]
        );

        PropertyType::factory()->create(
            [
                'id' => 2,
                'title' => 'Detatched',
            ]
        );

        PropertyType::factory()->create(
            [
                'id' => 3,
                'title' => 'Semi-detached',
            ]
        );

        PropertyType::factory()->create(
            [
                'id' => 4,
                'title' => 'Terraced',
            ]
        );

        PropertyType::factory()->create(
            [
                'id' => 5,
                'title' => 'End of Terrace',
            ]
        );

        PropertyType::factory()->create(
            [
                'id' => 6,
                'title' => 'Cottage',
            ]
        );

        PropertyType::factory()->create(
            [
                'id' => 7,
                'title' => 'Bungalow',
            ]
        );
    }
}
