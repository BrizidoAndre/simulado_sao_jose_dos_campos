<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'subscription_id',
        'amount',
        'transaction_date',
        'status',
        'worker_id',
        'usage_count',
        'description',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function worker()
    {
        return $this->belongsTo(Employee::class, 'worker_id');
    }

    protected function casts()
    {
        return [
            'transaction_date' => 'date',
        ];
    }

    #[Scope]
    protected function filterQuery(Builder $query)
    {
        return $query
            ->when(request('start_date'), function (Builder $query, $v) {
                $query->whereDate('transaction_date', '>=', $v);
            })
            ->when(request('end_date'), function (Builder $query, $v) {
                $query->whereDate('transaction_date', '<=', $v);
            })
            ->when(request('worker'), function (Builder $query, $v) {
                $query->where('worker_id', $v);
            })
            ->when(request('status'), function (Builder $query, $v) {
                $query->where('status', $v);
            })
            ->when(request('customer'), function (Builder $query, $v) {
                $query->whereHas('subscription', function (Builder $query) use ($v) {
                    $query->where('customer_id', $v);
                });
            })
            ->when(request('plan'), function (Builder $query, $v) {
                $query->whereHas('subscription', function (Builder $query) use ($v) {
                    $query->where('plan_id', $v);
                });
            });
    }
}
