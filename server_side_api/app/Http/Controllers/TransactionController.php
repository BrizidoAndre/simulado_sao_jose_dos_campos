<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\PaidTransactionResource;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class TransactionController extends Controller
{
    public function index()
    {
        $models = Transaction
            ::with(['subscription.plan', 'subscription.customer', 'worker'])
            ->filterQuery();
        return TransactionResource::collection($models->get());
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        if ($transaction->status !== 'Pending') {
            return response()->json([
                'errors' => [
                    'The transaction is not pending anymore'
                ]
            ], 400);
        }
        $transaction->update([
            ...$request->validated(),
        ]);
        $transaction->load(['worker', 'subscription']);
        return TransactionResource::make($transaction);
    }

    public function pay(Transaction $transaction)
    {
        /*manually recording errors*/
        $errors = [];
        if ($transaction->status !== 'Pending') {
            $errors[] = 'The transaction is already marked as finalized.';
        }
        if (!$transaction->worker) {
            $errors[] = 'The transaction must be associated with a professional in order to be marked as paid.';
        }
        if (count($errors) > 0) {
            return response()->json([
                'errors' => $errors
            ], 400);
        }
        $status = $transaction->amount === 0 ? 'Not Apply' : 'Paid';
        // if none of the rules above are breached then updates it
        $transaction->update([
            'status' => $status,
        ]);
        if ($status === 'Paid') {
            $usageNumber = $transaction->usage_count < $transaction->subscription->plan->monthly_usage_limit ? ($transaction->usage_count + 1) : 1;
            $amount = $usageNumber !== 1 ? 0 : $transaction->subscription->plan->price;
            $nextTransaction = Transaction::create([
                'subscription_id' => $transaction->subscription_id,
                'status' => 'Pending',
                'transaction_date' => Carbon::now()->modify("+{$transaction->subscription->plan->next_transaction} days"),
                'usage_count' => $usageNumber,
                'amount' => $amount,
            ]);
        }
        return PaidTransactionResource::make($transaction);
    }
}
