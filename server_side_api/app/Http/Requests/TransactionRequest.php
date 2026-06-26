<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'subscription_id' => ['required', 'exists:subscriptions,id'],
            'amount' => ['required', 'integer:strict', 'min:0'],
            'transaction_date' => ['required', Rule::date()->format('Y-m-d')],
            'worker_id' => ['required', 'exists:employees,id'],
            'usage_count' => ['required', 'integer:strict', 'min:1'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'worker_id.exists' => 'The selected worker does not exists.',
            'transaction_date.date_format' => 'The transaction date must be a valid date.',
            'amount.integer' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 0.',
            'usage_count.integer' => 'The usage must be an integer.',
            'usage_count.min' => 'The usage must be at least 1.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
