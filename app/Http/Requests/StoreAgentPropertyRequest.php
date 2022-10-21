<?php

namespace App\Http\Requests;

use App\Models\AgentProperty;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAgentPropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agent' => 'required|exists:App\Models\Agent,id',
            'property' => 'required|exists:App\Models\Property,id',
            'type' => 'required|in:' . implode(',', AgentProperty::TYPES),
        ];
    }
}
