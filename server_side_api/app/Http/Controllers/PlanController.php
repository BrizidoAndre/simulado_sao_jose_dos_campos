<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Http\Resources\PlanResource;
use App\Http\Resources\PlanShowResource;
use App\Models\Plan;

class PlanController extends Controller
{

    public function store(PlanRequest $request)
    {
        $plan = Plan::create($request->validated());
        return PlanResource::make($plan);
    }

    public function index()
    {
        return PlanShowResource::collection(Plan::all());
    }

    public function show(Plan $plan)
    {
        return PlanShowResource::make($plan);
    }

    public function update(PlanRequest $request, Plan $plan)
    {
        $plan->update([
            ...$request->validated(),
        ]);
        return PlanShowResource::make($plan);
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response()->noContent();
    }

}
