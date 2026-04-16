<template>
    <div>
        <button
            @click="fetchPostData"
            type="button"
            class="inline-block rounded border border-indigo-600 bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
        >
            View Details
        </button>

        <div
            v-if="isOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 px-4 backdrop-blur-sm"
        >
            <div
                class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl sm:p-8 text-left"
            >
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">
                        Post Information
                    </h3>

                    <button
                        @click="isOpen = false"
                        class="text-gray-400 hover:text-gray-600 transition"
                    >
                        <span class="sr-only">Close modal</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <div v-if="isLoading" class="flex justify-center py-8">
                    <p class="text-sm text-gray-500">Loading data...</p>
                </div>

                <div v-else-if="postData" class="flow-root">
                    <dl class="-my-3 divide-y divide-gray-100 text-sm">
                        <div
                            class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4"
                        >
                            <dt class="font-medium text-gray-900">Title</dt>
                            <dd class="text-gray-700 sm:col-span-2">
                                {{ postData.title }}
                            </dd>
                        </div>

                        <div
                            class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4"
                        >
                            <dt class="font-medium text-gray-900">Type</dt>
                            <dd class="sm:col-span-2">
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-blue-100 px-2.5 py-0.5 text-blue-700"
                                >
                                    {{ postData.type }}
                                </span>
                            </dd>
                        </div>

                        <div
                            class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4"
                        >
                            <dt class="font-medium text-gray-900">Content</dt>
                            <dd
                                class="text-gray-700 sm:col-span-2 whitespace-pre-wrap"
                            >
                                {{ postData.content }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div v-else class="text-center py-8 text-red-500 text-sm">
                    Failed to load post data.
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const props = defineProps({
    postId: {
        type: String,
        required: true,
    },
});

const isOpen = ref(false);
const isLoading = ref(false);
const postData = ref(null);

const fetchPostData = async () => {
    isOpen.value = true;

    if (postData.value) return;

    isLoading.value = true;

    try {
        const response = await axios.get(`/posts/${props.postId}/ajax`);
        postData.value = response.data;
    } catch (error) {
        console.error("Error fetching post data:", error);
    } finally {
        isLoading.value = false;
    }
};
</script>
