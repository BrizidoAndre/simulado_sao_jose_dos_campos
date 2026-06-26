<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->get();
        return view('todo.index', compact('todos'));
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todo.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);
        Todo::create([
            ...$data,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('todo.index');
    }

    public function edit(Todo $todo)
    {
        return view('todo.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'status' => ['required', Rule::in(['pending', 'doing', 'done'])]
        ]);
        $todo->update([
            ...$data,
        ]);
        return redirect()->route('todo.index');
    }
}
