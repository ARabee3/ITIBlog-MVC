<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::withTrashed()->orderByDesc('created_at')->paginate(12);

    return view('posts.index', compact('posts'));
  }

  public function show(string $uuid)
  {
    $post = Post::withTrashed()
      ->with([
        'user:id,name',
        'comments' => fn($query) => $query->latest(),
        'comments.user:id,name',
      ])
      ->where('uuid', $uuid)
      ->firstOrFail();

    return view('posts.show', compact('post'));
  }

  public function create()
  {
    return view('posts.create');
  }

  public function store(Request $request): RedirectResponse
  {
    $validated = $request->validate([
      'title' => [
        'required',
        'string',
        'min:3',
        'max:255',
        Rule::unique('posts', 'title')
      ],
      'content' => ['required', 'string', 'max:255'],
      'type' => ['required', 'string', 'max:255'],
      'image' => ['nullable', 'image', 'max:2048'],
    ]);

    $post = new Post();
    $post->uuid = (string) Str::uuid();
    $post->user_id = $request->user()->id;
    $post->title = $validated['title'];
    $post->content = $validated['content'];
    $post->type = $validated['type'];

    if ($request->hasFile('image')) {
      $path = $request->file('image')->store('posts', 'public');
      $post->image = $path;
    }

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
      'title' => [
        'required',
        'string',
        'min:3',
        'max:255',
        Rule::unique('posts', 'title')->ignore($uuid, 'uuid')
      ],
      'content' => ['required', 'string', 'max:255'],
      'type' => ['required', 'string', 'max:255'],
      'image' => ['nullable', 'image', 'max:2048'],
    ]);

    $post = Post::where('uuid', $uuid)->firstOrFail();
    $post->title = $validated['title'];
    $post->content = $validated['content'];
    $post->type = $validated['type'];

    if ($request->hasFile('image')) {
      if ($post->image) {
        Storage::disk('public')->delete($post->image);
      }
      $path = $request->file('image')->store('posts', 'public');
      $post->image = $path;
    }

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
