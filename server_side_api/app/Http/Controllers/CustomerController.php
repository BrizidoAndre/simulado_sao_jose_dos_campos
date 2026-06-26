<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerShowResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(CustomerRequest $request)
    {
        $model = Customer::create([
            ...$request->validated(),
        ]);
        return CustomerResource::make($model);
    }

    public function index()
    {
        $models = Customer::all();
        return CustomerShowResource::collection($models);
    }

    public function show(Customer $customer)
    {
        return CustomerShowResource::make($customer);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update([
            ...$request->validated(),
        ]);
        return CustomerResource::make($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->noContent();
    }
}
