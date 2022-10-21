<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AgentsApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Agents are return successfully.
     *
     * @return void
     */
    public function test_agents_are_returned_successfully()
    {
        $response = $this->get(route('agents.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(7, 'data');

        $response->assertJsonFragment(
            [
                'name' => 'Agent 1',
            ]
        );

        $response->assertJsonFragment(
            [
                'name' => 'Agent 2',
            ]
        );

        $response->assertJsonFragment(
            [
                'name' => 'Agent 3',
            ]
        );

        $response->assertJsonFragment(
            [
                'name' => 'Agent 4',
            ]
        );

        $response->assertJsonFragment(
            [
                'name' => 'Agent 5',
            ]
        );

        $response->assertJsonFragment(
            [
                'name' => 'Agent 6',
            ]
        );

        $response->assertJsonFragment(
            [
                'name' => 'Agent 7',
            ]
        );
    }

    /**
     * Agent validation
     *
     * @return void
     */
    public function test_agent_validation()
    {
        $response = $this->postJson(route('agents.store'), [
            'first_name' => '',
            'last_name' => 'Smith',
            'email' => 'john.smith@gmail.com',
            'phone' => '07777777777',
            'country' => 'United Kingdom',
            'address' => '123 Main Street',
            'City' => 'London',
            'region' => 'City of London',
            'postcode' => 'AB1 1AB'
        ]);

        $response->assertUnprocessable();
        $response->assertInvalid(
            [
                'first_name' => 'The first name field is required.',
            ]
        );
    }

    /**
     * Agent is saved successfully.
     *
     * @return void
     */
    public function test_agent_is_saved_successfully()
    {

        $response = $this->postJson(route('agents.store'), [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john.smith@gmail.com',
            'phone' => '07777777777',
            'country' => 'United Kingdom',
            'address' => '123 Main Street',
            'City' => 'London',
            'region' => 'City of London',
            'postcode' => 'AB1 1AB'
        ]);

        $response->assertStatus(201);
    }
}
