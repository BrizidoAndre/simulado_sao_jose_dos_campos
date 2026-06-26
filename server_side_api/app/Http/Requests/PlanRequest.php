<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
{
    public function rules()
    {
        $model = request('plan');
        return [
            'name' => ['required', 'string', Rule::unique('plans')->ignore($model)],
            'price' => ['required', 'integer:strict', 'min:1'],
            'monthly_usage_limit' => ['required', 'integer:strict', 'min:1'],
            'next_transaction' => ['integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'The name must be a string',
            'name.unique' => 'The name is already in use',
            'price.integer' => 'The :attribute must be a number.',
            'price.min' => 'The :attribute must be at least 1.',
            'monthly_usage_limit.integer' => 'The monthly usage limit must be an integer.',
            'monthly_usage_limit.integer.min' => 'The monthly usage limit must be at least 1.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
