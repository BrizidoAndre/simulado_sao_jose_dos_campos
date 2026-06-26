<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
//    a default controller resource request
// it has index, create, store, edit,update and destroy functions matching each description
// of course this methods follow Laravel best practices
    public function index()
    {
        return view('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);
        Category::create([
            ...$data,
        ]);
        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);
        $category->update([
            ...$data,
        ]);
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->posts()->update([
            'status' => 'Draft',
            'published_at' => null
        ]);
        $category->photos()->update([
            'category_id' => null,
        ]);
        $category->delete();
        return redirect()->route('category.index');
    }
}
