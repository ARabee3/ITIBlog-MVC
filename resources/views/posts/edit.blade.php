@extends('nav')

@section('PageTitle', 'Edit Post')

@section('Content')
    <section class="mx-auto mt-8 max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <h1 class="mb-6 text-2xl font-bold text-gray-900">Edit Post</h1>

            <form action="{{ route('posts.update', $post->uuid) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
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

                <div>
                    <label for="image" class="mb-1 block text-sm font-medium text-gray-700">Image</label>
                    @if($post->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($post->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-md">
                        </div>
                    @endif
                    <input id="image" name="image" type="file"
                        class="w-full rounded-md border-gray-300 text-sm shadow-xs">
                    @error('image')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <x-button type="primary" buttonType="submit" class="px-4 py-2 text-sm">
                        Update
                    </x-button>
                    <x-button type="secondary" href="{{ route('posts.index') }}" class="px-4 py-2 text-sm">
                        Cancel
                    </x-button>
                </div>
            </form>
        </div>
    </section>
@endsection
