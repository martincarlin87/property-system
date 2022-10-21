<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentRequest;
use App\Http\Resources\AgentCollection;
use App\Models\Agent;
use App\Services\AgentService;
use Illuminate\Http\Request;

class AgentsController extends Controller
{
    public function index()
    {
        $agents = Agent::with('properties')
            ->orderBy('first_name', 'asc')
            ->get();

        return new AgentCollection($agents);
    }

    public function store(StoreAgentRequest $request, AgentService $agentService)
    {
        return $agentService->create($request->validated());
    }
}
