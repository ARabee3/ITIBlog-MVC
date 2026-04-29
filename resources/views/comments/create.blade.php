@extends('nav')

@section('PageTitle', 'Create Comment')

@section('Content')
    <section class="mx-auto mt-8 max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <h1 class="mb-2 text-2xl font-bold text-gray-900">Add Comment</h1>
            <p class="mb-6 text-sm text-gray-600">Post: {{ $post->title }}</p>

            <form action="{{ route('comments.store', $post->uuid) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="content" class="mb-1 block text-sm font-medium text-gray-700">Comment</label>
                    <textarea id="content" name="content" rows="4" class="w-full rounded-md border-gray-300 text-sm shadow-xs">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <x-button type="primary" buttonType="submit" class="px-4 py-2 text-sm">
                        Save Comment
                    </x-button>
                    <x-button type="secondary" href="{{ route('posts.show', $post->uuid) }}" class="px-4 py-2 text-sm">
                        Cancel
                    </x-button>
                </div>
            </form>
        </div>
    </section>
@endsection
