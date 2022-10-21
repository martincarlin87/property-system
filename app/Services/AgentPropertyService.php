<?php

namespace App\Services;

use App\Models\Agent;
use Illuminate\Support\Collection;

class AgentPropertyService
{

    public function create($agentPropertyData): Agent
    {
        $agent = Agent::findOrFail($agentPropertyData['agent']);

        // attach the property to the agent, but we don't duplicates like we would get by using ->attach(),
        // so use ->syncWithoutDetaching() instead
        $agent->properties()->syncWithoutDetaching([$agentPropertyData['property'] => ['type' => $agentPropertyData['type']]]);

        return $agent;
    }
}
