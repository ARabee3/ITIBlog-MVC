<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware("auth");
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{uuid}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{uuid}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{uuid}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::patch('/posts/{uuid}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::get('/posts/{post:uuid}/ajax', function (Post $post) {
    return response()->json($post);
});

require __DIR__ . '/auth.php';
