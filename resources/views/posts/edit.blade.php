@extends('nav')

@section('PageTitle', 'Edit Post')

@section('Content')
    <section class="mx-auto mt-8 max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <h1 class="mb-6 text-2xl font-bold text-gray-900">Edit Post</h1>

            <form action="{{ route('posts.update', $post->uuid) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="mb-1 block text-sm font-medium text-gray-700">Title</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $post->title) }}"
                        class="w-full rounded-md border-gray-300 text-sm shadow-xs">
                    @error('title')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="mb-1 block text-sm font-medium text-gray-700">Content</label>
                    <input id="content" name="content" type="text" value="{{ old('content', $post->content) }}"
                        class="w-full rounded-md border-gray-300 text-sm shadow-xs">
                    @error('content')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="mb-1 block text-sm font-medium text-gray-700">Type</label>
                    <input id="type" name="type" type="text" value="{{ old('type', $post->type) }}"
                        class="w-full rounded-md border-gray-300 text-sm shadow-xs">
                    @error('type')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="rounded bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700">
                        Update
                    </button>
                    <a href="{{ route('posts.index') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
