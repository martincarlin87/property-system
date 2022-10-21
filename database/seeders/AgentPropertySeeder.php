<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\AgentProperty;
use Illuminate\Database\Seeder;

class AgentPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AgentProperty::factory()->create(
            [
                'agent_id' => 1,
                'property_id' => 1,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 1,
                'property_id' => 2,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 1,
                'property_id' => 3,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 2,
                'property_id' => 2,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 2,
                'property_id' => 3,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 3,
                'property_id' => 1,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 3,
                'property_id' => 3,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 3,
                'property_id' => 5,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 4,
                'property_id' => 3,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 4,
                'property_id' => 4,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 4,
                'property_id' => 6,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 5,
                'property_id' => 1,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 5,
                'property_id' => 2,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 5,
                'property_id' => 5,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 6,
                'property_id' => 4,
            ]
        );

        AgentProperty::factory()->create(
            [
                'agent_id' => 6,
                'property_id' => 6,
            ]
        );
    }
}
