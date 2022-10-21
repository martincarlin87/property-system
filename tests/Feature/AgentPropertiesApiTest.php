<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AgentPropertiesApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Agent Property validation
     *
     * @return void
     */
    public function test_agent_property_validation()
    {
        $response = $this->postJson(route('agent-properties.store'), []);

        $response->assertUnprocessable();
        $response->assertInvalid(
            [
                'agent' => 'The agent field is required.',
                'property' => 'The property field is required.',
                'type' => 'The type field is required.',
            ]
        );
    }

    /**
     * Agent Property agent validation
     *
     * @return void
     */
    public function test_agent_property_agent_validation()
    {
        $response = $this->postJson(route('agent-properties.store'), [
            'agent' => 123,
            'property' => 1,
            'type' => 'seller',
        ]);

        $response->assertUnprocessable();
        $response->assertInvalid(
            [
                'agent' => 'The selected agent is invalid.',
            ]
        );
    }

    /**
     * Agent Property property validation
     *
     * @return void
     */
    public function test_agent_property_property_validation()
    {
        $response = $this->postJson(route('agent-properties.store'), [
            'agent' => 1,
            'property' => 123,
            'type' => 'seller',
        ]);

        $response->assertUnprocessable();
        $response->assertInvalid(
            [
                'property' => 'The selected property is invalid.',
            ]
        );
    }

    /**
     * Agent Property type validation
     *
     * @return void
     */
    public function test_agent_property_type_validation()
    {
        $response = $this->postJson(route('agent-properties.store'), [
            'agent' => 1,
            'property' => 1,
            'type' => 'not a seller or coordinator',
        ]);

        $response->assertUnprocessable();
        $response->assertInvalid(
            [
                'type' => 'The selected type is invalid.',
            ]
        );
    }

    /**
     * Agent Property is saved successfully.
     *
     * @return void
     */
    public function test_agent_property_is_saved_successfully()
    {

        $response = $this->postJson(route('agent-properties.store'), [
            'agent' => 1,
            'property' => 1,
            'type' => 'seller',
        ]);

        $response->assertStatus(200);
    }

    /**
     * A property can only have one coordinator.
     *
     * @return void
     */
    public function test_property_can_only_have_one_coordinator()
    {
        // create a new Property that won't have any agents in the database
        $property = Property::factory()->create(
            [
                'address' => '123 High Street',
                'county' => 'North Lanarkshire',
                'country' => 'Scotland',
                'town' => 'Motherwell',
            ]
        );

        $response = $this->postJson(route('agent-properties.store'), [
            'agent' => 1,
            'property' => $property->id,
            'type' => 'coordinator',
        ]);

        $response->assertStatus(200);

        $secondResponse = $this->postJson(route('agent-properties.store'), [
            'agent' => 2,
            'property' => $property->id,
            'type' => 'coordinator',
        ]);

        $secondResponse->assertUnprocessable();
        $this->assertEquals('This property already has a coordinator', $secondResponse->json('message'));
    }

    /**
     * A property can have multiple sellers.
     *
     * @return void
     */
    public function test_property_can_have_multiple_sellers()
    {
        // create a new Property that won't have any agents in the database
        $property = Property::factory()->create(
            [
                'address' => '123 High Street',
                'county' => 'North Lanarkshire',
                'country' => 'Scotland',
                'town' => 'Motherwell',
            ]
        );

        $response = $this->postJson(route('agent-properties.store'), [
            'agent' => 1,
            'property' => $property->id,
            'type' => 'seller',
        ]);

        $response->assertStatus(200);

        $secondResponse = $this->postJson(route('agent-properties.store'), [
            'agent' => 2,
            'property' => $property->id,
            'type' => 'seller',
        ]);

        $secondResponse->assertStatus(200);
    }
}
