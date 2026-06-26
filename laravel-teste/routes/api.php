<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/todos', function () {
    return \App\Models\Todo::all();
});

Route::post('/todos', function (Request $request) {
    $data = $request->validate([
        'title' => ['required',],
        'content' => ['required',],
        'status' => ['required', \Illuminate\Validation\Rule::in(['pending', 'doing', 'done'])],
    ]);
    \App\Models\Todo::create([
        ...$data,
        'user_id' => 1,
    ]);
    return \App\Models\Todo::all();
});
