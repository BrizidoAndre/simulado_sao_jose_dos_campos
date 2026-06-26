<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeShowResource;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function store(EmployeeRequest $request)
    {
        $model = Employee::create([
            ...$request->validated(),
        ]);
        return EmployeeResource::make($model);
    }

    public function index()
    {
        $models = Employee::all();
        return EmployeeShowResource::collection($models);
    }

    public function show(Employee $employee)
    {
        return EmployeeShowResource::make($employee);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update([
            ...$request->validated(),
        ]);
        return EmployeeResource::make($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->noContent();
    }
}
