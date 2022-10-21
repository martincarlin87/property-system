<?php

namespace App\Services;

use App\Models\Agent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AgentService
{

    public function findCompetitors(): Collection
    {
        $agents = Agent::with('properties')->get();

        $competitorIds = new Collection();

        foreach ($agents as $agent) {
            // get all other agents
            $otherAgents = $agents->where('id', '!=', $agent->id);

            // keep a tally of competitors, we need at least two
            $competitorsFound = 0;

            foreach ($otherAgents as $otherAgent) {
                // use intersect to compare the properties from both agents
                $uniqueProperties = $agent->properties->pluck('id')->intersect($otherAgent->properties->pluck('id'))->unique();

                // if they have at least two in common, consider them competitors
                if ($uniqueProperties->count() >= 2) {
                    $competitorsFound++;
                }
            }

            // if the agent has at least two competitors, keep a note of their id
            if ($competitorsFound >= 2) {
                $competitorIds->push($agent->id);
            }
        }

        return Agent::with('properties')
            ->whereIn('id', $competitorIds->unique()->toArray())
            ->orderBy('id', 'asc')
            ->get();

    }

    public function findCompetitorsUsingDatabase(): array
    {
        $results = DB::select("
            with num_competing_properties as (
                select
                    agents.id as agent_id,
                    concat_ws(' ', agents.first_name, agents.last_name) as agent_name,
                    competitors.id as competitor_id,
                    concat_ws(' ', competitors.first_name, competitors.last_name) as competitor_name,
                    count(properties.id) as num_properties_competing,
                    group_concat(properties.town separator ' and ') as properties_competing
                from agents
                left join agent_property on agent_property.agent_id = agents.id
                left join properties on agent_property.property_id = properties.id
                left join agent_property as competing_agents_properties on competing_agents_properties.property_id = agent_property.property_id and competing_agents_properties.agent_id != agents.id
                left join agents as competitors on competitors.id = competing_agents_properties.agent_id
                group by agents.id, competitors.id
                having num_properties_competing >= ?
            )
            select
                num_competing_properties.agent_id,
                count(distinct num_competing_properties.competitor_id) as num_competitors,
                concat(agent_name, ' is competing with ', group_concat(concat(competitor_name, ' on ', properties_competing) separator '; ')) as 'narrative'
            from
                num_competing_properties
            group by
                agent_id, agent_name
            having num_competitors >= ?", [2, 2]
        );

        return $results;
    }

    public function create($agentData): Agent
    {
        return Agent::create($agentData);
    }
}
