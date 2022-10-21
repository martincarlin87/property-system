<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompetingAgentCollection;
use App\Services\AgentService;

class CompetingAgentsController extends Controller
{
    protected $agentService;

    /**
     * Instantiate a new controller instance.
     *
     * @param AgentService $agentService
     */
    public function __construct(AgentService $agentService)
    {
        $this->agentService = $agentService;
    }

    public function index()
    {
        $agentsWithCompetitors = $this->agentService->findCompetitors();
        return new CompetingAgentCollection($agentsWithCompetitors);
    }

    public function query()
    {
        return $this->agentService->findCompetitorsUsingDatabase();
    }
}
