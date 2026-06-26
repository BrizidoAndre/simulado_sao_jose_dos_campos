<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
//    a default controller resource request
// it has index, create, store, edit,update and destroy functions matching each description
// of course this methods follow Laravel best practices
    public function index()
    {
        $photos = Photo::all();
        return view('photo.index', compact('photos'));
    }

    public function create()
    {
        return view('photo.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image_path' => ['required', 'image'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);
        $image_path = $request->file('image_path')->move('imgs');
        Photo::create([
            ...$data,
            'image_path' => $image_path,
        ]);
        return redirect()->route('photo.index');
    }

    public function show(Photo $photo)
    {
        return view('photo.edit', compact('photo'));
    }

    public function update(Request $request, Photo $photo)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);
        $photo->update([
            ...$data,
        ]);
        return redirect()->route('photo.index');
    }

    public function destroy(Photo $photo)
    {
        unlink($photo->image_path);
        $photo->delete();
        return redirect()->route('photo.index');
    }

}
