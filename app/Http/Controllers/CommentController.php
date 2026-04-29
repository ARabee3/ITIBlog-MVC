<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CommentController extends Controller
{
  public function create(Post $post)
  {
    return view('comments.create', compact('post'));
  }

  public function store(Request $request, Post $post): RedirectResponse
  {
    $validated = $request->validate([
      'content' => ['required', 'string', 'max:255'],
    ]);

    $comment = new Comment();
    $comment->uuid = (string) Str::uuid();
    $comment->content = $validated['content'];
    $comment->post_uuid = $post->uuid;
    $comment->user_id = $request->user()->id;
    $comment->save();

    return redirect()->route('posts.show', $post->uuid)->with('success', 'Comment created successfully.');
  }

  public function edit(string $uuid)
  {
    $comment = Comment::with(['post', 'user'])->where('uuid', $uuid)->firstOrFail();

    abort_unless(Auth::id() === $comment->user_id, 403);

    return view('comments.edit', compact('comment'));
  }

  public function update(Request $request, string $uuid): RedirectResponse
  {
    $validated = $request->validate([
      'content' => ['required', 'string', 'max:255'],
    ]);

    $comment = Comment::where('uuid', $uuid)->firstOrFail();
    abort_unless($request->user()->id === $comment->user_id, 403);

    $comment->content = $validated['content'];
    $comment->save();

    return redirect()->route('posts.show', $comment->post_uuid)->with('success', 'Comment updated successfully.');
  }

  public function destroy(string $uuid): RedirectResponse
  {
    $comment = Comment::where('uuid', $uuid)->firstOrFail();
    abort_unless(Auth::id() === $comment->user_id, 403);

    $postUuid = $comment->post_uuid;
    $comment->delete();

    return redirect()->route('posts.show', $postUuid)->with('success', 'Comment deleted successfully.');
  }
}
