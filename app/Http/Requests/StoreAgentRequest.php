<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAgentRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'email' => 'nullable|email|unique:agents,email|max:255',
            'phone' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'region' => 'nullable|max:255',
            'postcode' => 'nullable|string|max:255',
        ];
    }
}
