<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::withTrashed()->orderByDesc('created_at')->paginate(12);

    return view('posts.index', compact('posts'));
  }

  public function create()
  {
    return view('posts.create');
  }

  public function store(Request $request): RedirectResponse
  {
    $validated = $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'content' => ['required', 'string', 'max:255'],
      'type' => ['required', 'string', 'max:255'],
    ]);

    $post = new Post();
    $post->uuid = (string) Str::uuid();
    $post->title = $validated['title'];
    $post->content = $validated['content'];
    $post->type = $validated['type'];
    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
  }

  public function edit(string $uuid)
  {
    $post = Post::where('uuid', $uuid)->firstOrFail();

    return view('posts.edit', compact('post'));
  }

  public function update(Request $request, string $uuid)
  {
    $validated = $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'content' => ['required', 'string', 'max:255'],
      'type' => ['required', 'string', 'max:255'],
    ]);

    $post = Post::where('uuid', $uuid)->firstOrFail();
    $post->title = $validated['title'];
    $post->content = $validated['content'];
    $post->type = $validated['type'];
    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
  }

  public function destroy(string $uuid)
  {
    $post = Post::where('uuid', $uuid)->firstOrFail();
    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post moved to trash successfully.');
  }

  public function restore(string $uuid)
  {
    $post = Post::withTrashed()->where('uuid', $uuid)->firstOrFail();
    $post->restore();

    return redirect()->route('posts.index')->with('success', 'Post restored successfully.');
  }
}
