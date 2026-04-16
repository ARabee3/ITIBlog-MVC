@extends('nav')

@section('PageTitle', 'Posts')

@section('Content')
    <section class="mx-auto mt-8 max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Posts</h1>
                <a href="{{ route('posts.create') }}"
                    class="inline-block rounded bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700">
                    Create Post
                </a>
            </div>

            @if (session('success'))
                <p class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </p>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y-2 divide-gray-200">
                    <thead class="ltr:text-left rtl:text-right">
                        <tr class="*:font-medium *:text-gray-900">
                            <th class="px-3 py-2 whitespace-nowrap">Title</th>
                            <th class="px-3 py-2 whitespace-nowrap">Content</th>
                            <th class="px-3 py-2 whitespace-nowrap">Type</th>
                            <th class="px-3 py-2 whitespace-nowrap">Created At</th>
                            <th class="px-3 py-2 whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($posts as $post)
                            <tr class="*:text-gray-900 *:first:font-medium">
                                <td class="px-3 py-2 whitespace-nowrap">{{ $post->title }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">{{ $post->content }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">{{ $post->type }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">{{ $post->created_at->format('F jS, Y') }}</td>

                                <td class="px-3 py-2 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('posts.edit', $post->uuid) }}"
                                            class="rounded bg-amber-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-amber-600">
                                            Edit
                                        </a>

                                        <div x-data="{ isOpen: false }" class="inline-block">

                                            <button type="button" @click="isOpen = true"
                                                class="rounded bg-red-600 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-red-700">
                                                Delete
                                            </button>

                                            <div x-show="isOpen" style="display: none;"
                                                class="fixed ml-8 flex items-center justify-center bg-black bg-opacity-50">

                                                <div @click.away="isOpen = false"
                                                    class="rounded-lg bg-white p-6 shadow-xl w-96">
                                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Are you sure?</h3>
                                                    <p class="text-sm text-gray-500 mb-4">This action cannot be undone.</p>

                                                    <div class="flex justify-end gap-3">
                                                        <button type="button" @click="isOpen = false"
                                                            class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300">
                                                            Cancel
                                                        </button>

                                                        <form method="POST"
                                                            action="{{ route('posts.destroy', $post->uuid) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500">
                                                                Yes, Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-6 text-center text-sm text-gray-500">
                                    No posts yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
