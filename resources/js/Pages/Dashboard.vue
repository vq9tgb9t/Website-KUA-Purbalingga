<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    posts: Array
});

const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);

const deleteForm = useForm({});

const deletePost = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus post ini?')) {
        deleteForm.delete(route('admin.posts.destroy', id));
    }
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
    });
};
</script>

<template>
    <Head title="Dashboard Admin" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard KUA
                </h2>
                <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                    <Link :href="route('admin.comments.index')" class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-md text-xs sm:text-sm font-semibold hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        Kelola Komentar
                    </Link>
                    <Link :href="route('admin.posts.create')" class="px-3 sm:px-4 py-2 bg-kemenag text-white rounded-md text-xs sm:text-sm font-semibold hover:bg-kemenag-dark transition">
                        + Tambah Post
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                
                <!-- Flash Message -->
                <div v-if="flashSuccess" class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ flashSuccess }}
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold">Daftar Berita & Artikel</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="p-4 font-semibold text-gray-600 text-sm">Judul</th>
                                    <th class="p-4 font-semibold text-gray-600 text-sm">Kategori</th>
                                    <th class="p-4 font-semibold text-gray-600 text-sm">Komentar</th>
                                    <th class="p-4 font-semibold text-gray-600 text-sm">Tanggal</th>
                                    <th class="p-4 font-semibold text-gray-600 text-sm text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in posts" :key="post.id" class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                    <td class="p-4">
                                        <p class="font-semibold text-gray-800 line-clamp-1">{{ post.title }}</p>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full font-medium">
                                            {{ post.category }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ post.comments_count }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ formatDate(post.created_at) }}
                                    </td>
                                    <td class="p-4 text-right space-x-2">
                                        <a :href="'/kabar/' + post.slug" target="_blank" class="inline-flex items-center justify-center p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-md transition" title="Lihat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <Link :href="route('admin.posts.edit', post.id)" class="inline-flex items-center justify-center p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </Link>
                                        <button @click="deletePost(post.id)" class="inline-flex items-center justify-center p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="posts.length === 0">
                                    <td colspan="5" class="p-8 text-center text-gray-500">
                                        Belum ada data berita atau artikel.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
