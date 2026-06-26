<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{
//    render the default homepage
    public function index()
    {
        return view('public.index');
    }

//    renders the gallery page
    public function gallery()
    {
        return view('public.gallery');
    }

// renders only the published posts
    public function posts()
    {
        $posts = Post::where('status', 'Published')->get();
        return view('public.blog', compact('posts'));
    }

    // store a new contact record
    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required',],
            'email' => ['required', 'email'],
            'message' => ['required',],
        ]);

        Contact::create([
            ...$data,
        ]);
        return redirect()->route('public.index')->with('message', 'Thanks for your contact!');
    }

    // show the specified post
    public function postShow(Post $post)
    {
        if ($post->status === 'Draft') {
            return redirect()->route('public.posts');
        }
        return view('public.posts', compact('post'));
    }
}
