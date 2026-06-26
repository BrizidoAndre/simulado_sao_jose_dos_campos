<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Transaction */
class PaidTransactionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'subscription_id' => $this->subscription_id,
            'amount' => $this->amount,
            'transaction_date' => $this->transaction_date->format('Y-m-d H:i'),
            'status' => mb_strtolower($this->status),
            'worker_id' => $this->worker_id,
            'usage_count' => $this->usage_count,
            'description' => $this->description,
            'subscription' => [
                'id' => $this->subscription->id,
                'customer_id' => $this->subscription->customer_id,
                'plan_id' => $this->subscription->plan_id,
                'start_date' => $this->subscription->start_date,
                'customer' => [
                    'id' => $this->subscription->customer->id,
                    'name' => $this->subscription->customer->name,
                ],
                'plan' => [
                    'id' => $this->subscription->plan->id,
                    'name' => $this->subscription->plan->name,
                    'price' => $this->subscription->plan->price,
                    'monthly_usage_limit' => $this->subscription->plan->monthly_usage_limit,
                ],
            ],
            'worker' => new EmployeeTransactionResource($this->whenLoaded('worker')),
        ];
    }
}
