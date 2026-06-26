<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    public function rules()
    {
        $id = request('customer');
        return [
            'name' => ['required', Rule::unique('customers')->ignore($id)],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The name is already in use.'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
