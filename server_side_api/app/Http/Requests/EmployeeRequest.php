<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    public function rules()
    {
        $model = request('employee');
        return [
            'name' => ['required', Rule::unique('employees')->ignore($model)],
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
