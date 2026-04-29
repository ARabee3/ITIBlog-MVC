<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\GithubAuthController;
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

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{uuid}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{uuid}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{uuid}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::patch('/posts/{uuid}/restore', [PostController::class, 'restore'])->name('posts.restore');

    Route::post('/posts/{post:uuid}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/posts/{post:uuid}/comments/create', [CommentController::class, 'create'])->name('comments.create');
    Route::get('/comments/{uuid}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{uuid}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{uuid}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{uuid}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post:uuid}/ajax', function (Post $post) {
    return response()->json($post);
});

Route::get('/auth/github', [GithubAuthController::class, 'redirect'])->name('github.login');
Route::get('/auth/github/callback', [GithubAuthController::class, 'callback']);

require __DIR__ . '/auth.php';
