<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    comments: Object
});

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const deleteComment = (commentId) => {
    if (confirm('Yakin ingin menghapus komentar ini?')) {
        router.delete(route('admin.comments.destroy', commentId));
    }
};
</script>

<template>
    <Head title="Manajemen Komentar" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Link :href="route('dashboard')" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    </Link>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        Manajemen Komentar
                    </h2>
                </div>
                <span class="text-sm text-gray-500">Total: {{ comments.total }} komentar</span>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                    <!-- Empty State -->
                    <div v-if="comments.data.length === 0" class="p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-500">Belum ada komentar</h3>
                        <p class="text-sm text-gray-400 mt-1">Komentar dari pengunjung akan muncul di sini.</p>
                    </div>

                    <!-- Comment List -->
                    <div v-else class="divide-y divide-gray-100">
                        <div v-for="comment in comments.data" :key="comment.id" class="p-5 hover:bg-gray-50/50 transition-colors">
                            <div class="flex items-start gap-4">
                                <!-- Avatar -->
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-kemenag/10 text-kemenag font-semibold flex items-center justify-center text-sm">
                                    {{ comment.name.charAt(0).toUpperCase() }}
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-semibold text-gray-900 text-sm">{{ comment.name }}</span>
                                        <span class="text-xs text-gray-400">•</span>
                                        <span class="text-xs text-gray-400">{{ comment.email }}</span>
                                    </div>

                                    <!-- Post Reference -->
                                    <Link v-if="comment.post" :href="route('posts.show', comment.post.slug)" class="inline-flex items-center gap-1 mt-1 text-xs text-kemenag hover:text-kemenag-dark transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                        {{ comment.post.title }}
                                    </Link>
                                    <span v-else class="inline-block mt-1 text-xs text-gray-400 italic">Post telah dihapus</span>

                                    <!-- Comment Text -->
                                    <p class="mt-2 text-sm text-gray-700 leading-relaxed">{{ comment.content }}</p>

                                    <!-- Footer -->
                                    <div class="flex items-center justify-between mt-3">
                                        <span class="text-xs text-gray-400">{{ formatDate(comment.created_at) }}</span>
                                        <button @click="deleteComment(comment.id)" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-md hover:bg-red-100 hover:text-red-700 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div v-if="comments.last_page > 1" class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <p class="text-sm text-gray-500 text-center sm:text-left">
                            Menampilkan {{ comments.from }} - {{ comments.to }} dari {{ comments.total }}
                        </p>
                        <div class="flex flex-wrap justify-center gap-1">
                            <template v-for="link in comments.links" :key="link.label">
                                <Link
                                    v-if="link.url"
                                    :href="link.url"
                                    class="px-3 py-1.5 text-xs rounded-md transition-colors"
                                    :class="link.active ? 'bg-kemenag text-white font-semibold' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-100'"
                                    v-html="link.label"
                                />
                                <span v-else class="px-3 py-1.5 text-xs text-gray-300" v-html="link.label" />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
