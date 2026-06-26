<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\SubscriptionShowResource;
use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function store(SubscriptionRequest $request)
    {
        $model = Subscription::create([
            ...$request->validated(),
        ]);
        $model->load(['customer', 'plan']);
        $model->transactions()->create([
            'amount' => $model->plan->price,
            'transaction_date' => $model->start_date,
            'usage_count' => 1,
        ]);

        return SubscriptionResource::make($model);
    }

    public function index()
    {
        $models = Subscription::with(['plan', 'customer'])->get();
        return SubscriptionShowResource::collection($models);
    }

    public function show(Subscription $subscription)
    {
        $subscription->load(['customer', 'plan']);
        return SubscriptionShowResource::make($subscription);
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update([
            ...$request->validated(),
        ]);
        $subscription->load(['plan', 'customer']);
        return SubscriptionResource::make($subscription);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->noContent();
    }
}
