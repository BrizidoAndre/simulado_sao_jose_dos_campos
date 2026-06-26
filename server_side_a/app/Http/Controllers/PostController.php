<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
//    a default controller resource request
// it has index, create, store, edit,update and destroy functions matching each description
// of course this methods follow Laravel best practices
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => ['required'],
            "image_path" => ['required', 'image'],
            "content" => ['required'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);
        $image_path = $request->file('image_path')->move('posts_images');
        Post::create([
            ...$data,
            'image_path' => $image_path
        ]);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            "title" => ['required'],
            "image_path" => ['nullable', 'image'],
            "content" => ['required'],
            "status" => ['required', Rule::in(['Draft', 'Published'])],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);
        $image_path = $post->image_path;
        if ($request->file('image_path')) {
            $image_path = $request->file('image_path')->move('posts_images');
        }
        $published_at = $post->published_at;
        if ($data['status'] === 'Published' && $post->getOriginal('status') === 'Draft') {
            $published_at = date('Y-m-d H:i:s');
        }
        $post->update([
            ...$data,
            'image_path' => $image_path,
            'published_at' => $published_at
        ]);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        unlink($post->image_path);
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function toggle(Post $post)
    {
        // toggle between status
        if ($post->status === 'Draft') {
            $post->update([
                'published_at' => date('Y-m-d H:i:s'),
                'status' => 'Published',
            ]);
        } else {
            $post->update([
                'published_at' => null,
                'status' => 'Draft',
            ]);
        }
        return redirect()->route('posts.index');
    }
}
