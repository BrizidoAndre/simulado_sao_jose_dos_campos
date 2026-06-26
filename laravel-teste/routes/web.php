<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', './login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'logon'])->name('auth.logon');

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'signup'])->name('auth.signup');

Route::middleware('auth')->group(function () {
    Route::get('todos', [TodoController::class, 'index'])->name('todo.index');
    Route::post('todos', [TodoController::class, 'store'])->name('todo.store');
    Route::get('todos/{todo}', [TodoController::class, 'edit'])->name('todo.edit');
    Route::put('todos/{todo}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('todos/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
});
