@extends('nav')

@section('PageTitle', 'Posts')

@section('Content')
    <div id="app">
        <section class="mx-auto mt-8 max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900">Posts</h1>
                    <x-button type="primary" href="{{ route('posts.create') }}" class="px-4 py-2 text-sm">
                        Create Post
                    </x-button>
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
                                <th class="px-3 py-2 whitespace-nowrap">Status</th>
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
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        @if ($post->trashed())
                                            <span
                                                class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700">Deleted</span>
                                        @else
                                            <span
                                                class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">Active</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $post->created_at->format('F jS, Y') }}</td>

                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="flex items-center gap-2">

                                            <post-view-modal post-id="{{ $post->uuid }}"></post-view-modal>

                                            @if ($post->trashed())
                                                <form method="POST" action="{{ route('posts.restore', $post->uuid) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <x-button type="primary" buttonType="submit">
                                                        Restore
                                                    </x-button>
                                                </form>
                                            @else
                                                <x-button type="secondary" href="{{ route('posts.edit', $post->uuid) }}">
                                                    Edit
                                                </x-button>

                                                <div x-data="{ isOpen: false }" class="inline-block">
                                                    <x-button type="danger" @click="isOpen = true">
                                                        Delete
                                                    </x-button>

                                                    <div x-show="isOpen" style="display: none;"
                                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

                                                        <div @click.away="isOpen = false"
                                                            class="rounded-lg bg-white p-6 shadow-xl w-96">
                                                            <h3 class="text-lg font-bold text-gray-900 mb-2">Are you sure?
                                                            </h3>
                                                            <p class="text-sm text-gray-500 mb-4">This action cannot be
                                                                undone.
                                                            </p>

                                                            <div class="flex justify-end gap-3">
                                                                <x-button type="secondary" @click="isOpen = false"
                                                                    class="px-4 py-2 text-sm">
                                                                    Cancel
                                                                </x-button>

                                                                <form method="POST"
                                                                    action="{{ route('posts.destroy', $post->uuid) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <x-button type="danger" buttonType="submit"
                                                                        class="px-4 py-2 text-sm">
                                                                        Yes, Delete
                                                                    </x-button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-6 text-center text-sm text-gray-500">
                                        No posts yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-8">
                {{ $posts->withQueryString()->links() }}
            </div>
        </section>
    </div>
@endsection
