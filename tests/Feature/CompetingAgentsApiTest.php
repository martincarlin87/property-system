<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompetingAgentsApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test that competitors are returned correctly
     *
     * @return void
     */
    public function test_competing_agents_are_returned_successfully()
    {
        $response = $this->get(route('competing-agents.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');

        $response->assertJsonFragment(
            [
                'name' => 'Agent 1',
            ]
        );

        $response->assertJsonFragment(
            [
                'name' => 'Agent 3',
            ]
        );

        $response->assertJsonFragment(
            [
                'name' => 'Agent 5',
            ]
        );
    }

    /**
     * Test that competitors are returned correctly
     *
     * @return void
     */
    public function test_competing_agents_query()
    {
        $response = $this->get(route('competing-agents.query'));

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJsonFragment(
            [
                'agent_id' => 1,
            ]
        );

        $response->assertJsonFragment(
            [
                'agent_id' => 3,
            ]
        );

        $response->assertJsonFragment(
            [
                'agent_id' => 5,
            ]
        );

        $response->assertSeeText('Agent 1 is competing with Agent 2');
        $response->assertSeeText('Agent 3 on ');

        $response->assertSeeText('Agent 3 is competing with Agent 1');
        $response->assertSeeText('Agent 5 on ');

        $response->assertSeeText('Agent 5 is competing with Agent 1 on ');
        $response->assertSeeText('Agent 3 on ');
    }
}
