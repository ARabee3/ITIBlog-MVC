<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('index');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{uuid}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{uuid}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{uuid}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::patch('/posts/{uuid}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::get('/posts/{post:uuid}/ajax', function (Post $post) {
    return response()->json($post);
});
