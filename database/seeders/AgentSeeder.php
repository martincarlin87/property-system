<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 7; $i++) {
            Agent::factory()->create(
                [
                    'first_name' => 'Agent ' . $i + 1,
                    'last_name' => null,
                ]
            );
        }
    }
}
