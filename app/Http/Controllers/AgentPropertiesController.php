<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentPropertyRequest;
use App\Models\AgentProperty;
use App\Models\Property;
use App\Services\AgentPropertyService;
use Illuminate\Http\Request;

class AgentPropertiesController extends Controller
{
    public function store(StoreAgentPropertyRequest $request, AgentPropertyService $agentPropertyService)
    {
        // check there's no existing agents acting as a coordinator for viewings, there can only be one of these
        // but there can be multiple sellers
        $property = Property::findOrFail($request->property);

        if ($request->type === AgentProperty::COORDINATOR && $property->coordinatorAgents->count() > 0) {
            return abort(422, 'This property already has a coordinator');
        }

        return $agentPropertyService->create($request->validated());
    }
}
