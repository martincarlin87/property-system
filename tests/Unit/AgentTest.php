<?php

namespace Tests\Unit;

use App\Models\Agent;
use PHPUnit\Framework\TestCase;

class AgentTest extends TestCase
{
    /**
     * Test that the correct name string is returned
     *
     * @return void
     */
    public function test_that_the_agent_name_is_returned_correctly()
    {
        $agent = new Agent(
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
            ]
        );

        $this->assertEquals('John Smith', $agent->name);

        $agent->last_name = null;

        $this->assertEquals('John', $agent->name);
    }
}
