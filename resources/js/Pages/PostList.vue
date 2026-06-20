<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    posts: {
        type: Object,
        required: true
    },
    category: {
        type: String,
        default: 'Kabar KUA'
    }
});

const categoryDescriptions = {
    'Berita KUA': 'Berita dan informasi terkini seputar kegiatan Kantor Urusan Agama Kecamatan Purbalingga.',
    'Urab Mendoan': 'Update seputar program inovasi URAB MENDOAN (Urusan Agama Bersama Mendampingi Orang yang Membutuhkan).',
    'Artikel': 'Artikel edukatif seputar keagamaan, keluarga sakinah, dan layanan KUA.',
};

const categoryColors = {
    'Berita KUA': 'bg-blue-100 text-blue-700',
    'Urab Mendoan': 'bg-emerald-100 text-emerald-700',
    'Artikel': 'bg-amber-100 text-amber-700',
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const getExcerpt = (content) => {
    const plainText = content ? content.replace(/<[^>]+>/g, '') : '';
    return plainText.substring(0, 100) + '...';
};
</script>

<template>
    <Head :title="category" />
    <MainLayout>
        <section class="bg-gradient-to-b from-kemenag-light/20 to-white py-12 sm:py-20 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">{{ category }}</h1>
                <p class="mt-4 text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ categoryDescriptions[category] || 'Informasi terbaru dari KUA Kecamatan Purbalingga.' }}
                </p>
            </div>
        </section>

        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Empty State -->
                <div v-if="!posts.data || posts.data.length === 0" class="text-center py-20">
                    <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Postingan</h3>
                    <p class="text-gray-500 text-sm">Belum ada konten untuk kategori {{ category }}. Nantikan update terbaru dari kami.</p>
                </div>

                <!-- Grid Kartu Berita -->
                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link v-for="(post, index) in posts.data" :key="index" :href="'/kabar/' + post.slug"
                             class="group bg-white rounded-2xl overflow-hidden shadow-card border border-gray-100 hover:shadow-lg hover:border-kemenag/30 transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Thumbnail -->
                        <div class="h-52 bg-gradient-to-br from-kemenag/10 to-kemenag/5 flex items-center justify-center relative overflow-hidden">
                            <img v-if="post.image_path" :src="'/storage/' + post.image_path" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" :alt="post.title">
                            <svg v-else class="w-16 h-16 text-kemenag/20 relative z-10 transition-transform duration-500 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <!-- Konten -->
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <span :class="categoryColors[post.category] || 'bg-gray-100 text-gray-600'" class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider">
                                    {{ post.category }}
                                </span>
                                <span class="text-sm text-gray-400 font-medium">{{ formatDate(post.created_at) }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 leading-snug group-hover:text-kemenag transition-colors line-clamp-2">
                                {{ post.title }}
                            </h3>
                            <p class="mt-3 text-base text-gray-600 leading-relaxed line-clamp-3">
                                {{ getExcerpt(post.content) }}
                            </p>
                        </div>
                    </Link>
                </div>

                <!-- Pagination (Sederhana) -->
                <div class="mt-16 flex flex-wrap justify-center gap-2" v-if="posts.links && posts.links.length > 3">
                    <template v-for="(link, index) in posts.links" :key="index">
                        <Link v-if="link.url" 
                              :href="link.url"
                              v-html="link.label"
                              :class="[
                                  'px-4 py-2 text-sm font-medium rounded-lg transition-colors',
                                  link.active ? 'bg-kemenag text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                              ]"
                        ></Link>
                        <span v-else 
                              v-html="link.label"
                              class="px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed"
                        ></span>
                    </template>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
