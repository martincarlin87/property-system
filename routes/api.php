<?php

use App\Http\Controllers\AgentPropertiesController;
use App\Http\Controllers\AgentsController;
use App\Http\Controllers\CompetingAgentsController;
use App\Http\Controllers\PropertiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/agents', [AgentsController::class, 'index'])->name('agents.index');
Route::post('/agents', [AgentsController::class, 'store'])->name('agents.store');

Route::get('/competing-agents', [CompetingAgentsController::class, 'index'])->name('competing-agents.index');
Route::get('/competing-agents/query', [CompetingAgentsController::class, 'query'])->name('competing-agents.query');

Route::get('/properties', [PropertiesController::class, 'index'])->name('properties.index');
Route::post('/agent-properties', [AgentPropertiesController::class, 'store'])->name('agent-properties.store');
