@extends('nav')

@section('PageTitle', 'Post Details')

@section('Content')
    <section class="mx-auto mt-8 max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-center justify-between gap-3">
                <h1 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h1>
                <x-button type="secondary" href="{{ route('posts.index') }}">Back to Posts</x-button>
            </div>

            @if (session('success'))
                <p class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </p>
            @endif

            <div class="space-y-3 rounded-lg border border-gray-100 bg-gray-50 p-4">
                <p class="text-sm text-gray-600"><span class="font-semibold text-gray-800">Slug:</span>
                    {{ $post->slug ?? '-' }}</p>
                <p class="text-sm text-gray-600"><span class="font-semibold text-gray-800">Type:</span> {{ $post->type }}
                </p>
                <p class="text-sm text-gray-600"><span class="font-semibold text-gray-800">Created By:</span>
                    {{ $post->user?->name ?? 'Unknown' }}</p>
                @if($post->image)
                <p class="text-sm text-gray-600 mt-2"><span class="font-semibold text-gray-800 block mb-1">Image:</span>
                    <img src="{{ Storage::url($post->image) }}" alt="Post Image" class="max-w-xs h-auto rounded-md border border-gray-200">
                </p>
                @endif
                <p class="text-sm text-gray-600 mt-2"><span class="font-semibold text-gray-800">Content:</span>
                    {{ $post->content }}</p>
            </div>

            <div class="mt-8">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-900">Comments</h2>

                    @auth
                        @if (!$post->trashed())
                            <x-button type="primary" href="{{ route('comments.create', $post->uuid) }}">Add Comment</x-button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">Sign in to comment</a>
                    @endauth
                </div>

                @if ($post->trashed())
                    <p class="mb-4 rounded border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                        This post is deleted. Commenting is disabled.
                    </p>
                @endif

                <div class="space-y-3">
                    @forelse ($post->comments as $comment)
                        <article class="rounded-lg border border-gray-200 bg-white p-4">
                            <div class="mb-2 flex items-start justify-between gap-3">
                                <p class="text-sm text-gray-600">
                                    <span
                                        class="font-semibold text-gray-800">{{ $comment->user?->name ?? 'Unknown User' }}</span>
                                    <span
                                        class="ml-2 text-xs text-gray-500">{{ $comment->created_at?->format('M j, Y g:i A') }}</span>
                                </p>

                                @auth
                                    @if (auth()->id() === $comment->user_id)
                                        <div class="flex items-center gap-2">
                                            <x-button type="secondary"
                                                href="{{ route('comments.edit', $comment->uuid) }}">Edit</x-button>

                                            <form action="{{ route('comments.destroy', $comment->uuid) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-button type="danger" buttonType="submit">Delete</x-button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <p class="text-sm text-gray-800">{{ $comment->content }}</p>
                        </article>
                    @empty
                        <p class="rounded border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-600">
                            No comments yet.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
