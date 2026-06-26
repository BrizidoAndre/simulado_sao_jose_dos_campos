<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// public related routes
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::post('/contacts', [PublicController::class, 'contactStore'])->name('public.contact.store');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('public.gallery');
Route::get('/posts', [PublicController::class, 'posts'])->name('public.posts');
Route::get('/posts/{post}', [PublicController::class, 'postShow'])->name('public.posts.show');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'logon'])->name('logon');

//authenticated routes
// must have an admin-panel prefix
Route::prefix('admin-panel')->middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('', [ContactController::class, 'index'])->name('admin.index');
    Route::resource('posts', PostController::class);
    Route::get('posts/toggle/{post}', [PostController::class, 'toggle'])->name('post.toggle');
    Route::resource('photo', PhotoController::class);
    Route::resource('category', CategoryController::class);
    Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
});
