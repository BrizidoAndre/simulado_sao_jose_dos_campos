<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//public routes
Route::post('/login', [AuthController::class, 'login']);


// authenticated routes
Route::middleware('auth:api-token')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

//    customer handling routes
    Route::prefix('/customers')->group(function () {
        Route::post('', [CustomerController::class, 'store']);
        Route::get('', [CustomerController::class, 'index']);
        Route::get('/{customer}', [CustomerController::class, 'show']);
        Route::put('/{customer}', [CustomerController::class, 'update']);
        Route::delete('/{customer}', [CustomerController::class, 'destroy']);
    });
    Route::prefix('/workers')->group(function () {
        Route::post('', [EmployeeController::class, 'store']);
        Route::get('', [EmployeeController::class, 'index']);
        Route::get('/{employee}', [EmployeeController::class, 'show']);
        Route::put('/{employee}', [EmployeeController::class, 'update']);
        Route::delete('/{employee}', [EmployeeController::class, 'destroy']);
    });

    Route::prefix('/plans')->group(function () {
        Route::post('', [PlanController::class, 'store']);
        Route::get('', [PlanController::class, 'index']);
        Route::get('/{plan}', [PlanController::class, 'show']);
        Route::put('/{plan}', [PlanController::class, 'update']);
        Route::delete('/{plan}', [PlanController::class, 'destroy']);
    });

    Route::prefix('subscriptions')->group(function () {
        Route::post('', [SubscriptionController::class, 'store']);
        Route::get('', [SubscriptionController::class, 'index']);
        Route::get('/{subscription}', [SubscriptionController::class, 'show']);
        Route::put('/{subscription}', [SubscriptionController::class, 'update']);
        Route::delete('/{subscription}', [SubscriptionController::class, 'destroy']);
    });

    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update']);
    Route::post('/transactions/{transaction}/mark-as-paid', [TransactionController::class, 'pay']);
});
