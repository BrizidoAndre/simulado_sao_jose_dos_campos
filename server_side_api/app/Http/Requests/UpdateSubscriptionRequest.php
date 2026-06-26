<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubscriptionRequest extends FormRequest
{

    public function rules()
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'plan_id' => ['required', 'exists:plans,id'],
            'start_date' => ['required', Rule::date()->format('Y-m-d')],
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'The customer field is required.',
            'customer_id.unique' => 'The customer already has a subscription',
            'customer_id.exists' => 'The selected customer does not exists',
            'plan_id.required' => 'The plan field is required.',
            'plan_id.exists' => 'The selected plan does not exists',
            'start_date.date_format' => 'The start date must be a valid date'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
