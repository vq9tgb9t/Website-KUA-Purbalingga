<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        weekday: 'long'
    });
};

const categoryColors = {
    'Berita KUA': 'bg-blue-100 text-blue-700',
    'Urab Mendoan': 'bg-emerald-100 text-emerald-700',
    'Artikel': 'bg-amber-100 text-amber-700',
};

import { computed, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    content: ''
});

onMounted(() => {
    const savedName = localStorage.getItem('kua_comment_name');
    const savedEmail = localStorage.getItem('kua_comment_email');
    if (savedName) form.name = savedName;
    if (savedEmail) form.email = savedEmail;
});

const submitComment = () => {
    // Simpan ke local storage
    localStorage.setItem('kua_comment_name', form.name);
    localStorage.setItem('kua_comment_email', form.email);

    form.post(`/kabar/${props.post.slug}/comments`, {
        preserveScroll: true,
        onSuccess: () => {
            form.content = ''; // Hanya reset konten, biarkan nama dan email
        }
    });
};

const backLink = computed(() => {
    switch (props.post.category) {
        case 'Berita KUA': return '/berita-kua';
        case 'Urab Mendoan': return '/urab-mendoan';
        case 'Artikel': return '/artikel';
        default: return '/berita-kua';
    }
});

const backLabel = computed(() => {
    switch (props.post.category) {
        case 'Berita KUA': return 'Kembali ke Berita KUA';
        case 'Urab Mendoan': return 'Kembali ke Urab Mendoan';
        case 'Artikel': return 'Kembali ke Artikel';
        default: return 'Kembali ke Kabar KUA';
    }
});
</script>

<template>
    <Head :title="post.title" />
    <MainLayout>
        <!-- Header Artikel -->
        <section class="bg-gradient-to-b from-kemenag-light/10 to-white pt-12 pb-8 border-b border-gray-100">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex justify-center items-center gap-3 mb-6">
                    <span :class="categoryColors[post.category] || 'bg-gray-100 text-gray-600'" class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-sm">
                        {{ post.category }}
                    </span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight tracking-tight mb-6">
                    {{ post.title }}
                </h1>
                <div class="flex items-center justify-center gap-4 text-sm text-gray-500 font-medium">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ formatDate(post.created_at) }}
                    </div>
                </div>
            </div>
        </section>

        <!-- Konten Artikel -->
        <section class="py-12 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Thumbnail/Featured Image -->
                <div class="w-full aspect-video bg-gradient-to-br from-gray-100 to-gray-50 rounded-3xl overflow-hidden mb-12 border border-gray-100 shadow-sm flex items-center justify-center relative">
                    <img v-if="post.image_path" :src="'/storage/' + post.image_path" class="w-full h-full object-cover" :alt="post.title">
                    <svg v-else class="w-24 h-24 text-gray-300 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <!-- Teks Konten -->
                <article class="prose prose-lg prose-kemenag max-w-none text-gray-700 leading-relaxed ql-editor-content text-justify">
                    <div v-html="post.content"></div>
                </article>

                <div class="mt-16 pt-12 border-t border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Komentar ({{ post.comments?.length || 0 }})</h3>

                    <!-- List Komentar -->
                    <div class="space-y-6 mb-12">
                        <div v-if="!post.comments || post.comments.length === 0" class="text-gray-500 italic text-sm">
                            Belum ada komentar. Jadilah yang pertama berkomentar!
                        </div>
                        <div v-for="comment in post.comments" :key="comment.id" class="bg-gray-50 rounded-2xl p-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-kemenag/10 text-kemenag rounded-full flex items-center justify-center font-bold text-lg">
                                    {{ comment.name.charAt(0).toUpperCase() }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ comment.name }}</h4>
                                    <p class="text-xs text-gray-500">{{ formatDate(comment.created_at) }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ comment.content }}</p>
                        </div>
                    </div>

                    <!-- Form Komentar -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                        <h4 class="text-lg font-bold text-gray-900 mb-6">Tinggalkan Komentar</h4>
                        <form @submit.prevent="submitComment" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
                                    <input v-model="form.name" type="text" required class="w-full rounded-lg border-gray-300 focus:border-kemenag focus:ring-kemenag shadow-sm">
                                    <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input v-model="form.email" type="email" required class="w-full rounded-lg border-gray-300 focus:border-kemenag focus:ring-kemenag shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        Email Anda aman dan tidak akan dipublikasikan.
                                    </p>
                                    <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Komentar *</label>
                                <textarea v-model="form.content" required rows="4" class="w-full rounded-lg border-gray-300 focus:border-kemenag focus:ring-kemenag shadow-sm"></textarea>
                                <div v-if="form.errors.content" class="text-red-500 text-xs mt-1">{{ form.errors.content }}</div>
                            </div>
                            <div class="text-right">
                                <button type="submit" :disabled="form.processing" class="px-6 py-2 bg-kemenag hover:bg-kemenag-dark text-white font-semibold rounded-lg shadow-sm transition-colors disabled:opacity-50">
                                    {{ form.processing ? 'Mengirim...' : 'Kirim Komentar' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-16 pt-8 border-t border-gray-100 flex justify-center">
                    <Link :href="backLink" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        {{ backLabel }}
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style>
/* Custom typography styles matching kemenag theme if needed */
.prose-kemenag p {
    margin-bottom: 1.5em;
}
</style>
