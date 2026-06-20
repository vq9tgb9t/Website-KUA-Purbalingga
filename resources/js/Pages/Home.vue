<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// Data program layanan (9 layanan utama sesuai website lama)
const services = [
    { name: 'Pendaftaran Nikah', icon: 'fa-solid fa-ring', desc: 'Daftar nikah secara online' },
    { name: 'Duplikat Buku Nikah', icon: 'fa-solid fa-file-contract', desc: 'Pengajuan duplikat buku nikah' },
    { name: 'Bimbingan Perkawinan', icon: 'fa-solid fa-people-roof', desc: 'Konseling pra-nikah' },
    { name: 'Rekomendasi Nikah', icon: 'fa-solid fa-file-invoice', desc: 'Surat rekomendasi menikah' },
    { name: 'Pendaftaran Wakaf', icon: 'fa-solid fa-mosque', desc: 'Daftarkan tanah wakaf Anda' },
    { name: 'ID Masjid / Mushalla', icon: 'fa-solid fa-landmark', desc: 'Pendataan masjid & mushalla' },
    { name: 'Madrasah Diniyah', icon: 'fa-solid fa-book-open', desc: 'Informasi madrasah diniyah' },
    { name: 'Majelis Taklim', icon: 'fa-solid fa-graduation-cap', desc: 'Pendaftaran majelis taklim' },
    { name: 'Manasik Haji', icon: 'fa-solid fa-kaaba', desc: 'Bimbingan manasik haji' },
];

// Menerima prop dari server (Inertia)
defineProps({
    latestPosts: {
        type: Array,
        default: () => [],
    }
});

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
    <Head title="Beranda" />
    <MainLayout>
        <!-- ============ HERO SECTION ============ -->
        <section class="relative overflow-hidden bg-gradient-to-br from-kemenag-dark via-kemenag to-kemenag-light">
            <!-- Pattern overlay islami (geometris halus) -->
            <div class="absolute inset-0 opacity-[0.07]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-28">
                <div class="text-center max-w-3xl mx-auto">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/15 backdrop-blur-sm rounded-full text-white/90 text-xs font-medium mb-6 border border-white/20">
                        <span class="w-2 h-2 bg-accent rounded-full animate-pulse"></span>
                        #BersihMelayani
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight">
                        Kantor Urusan Agama
                        <span class="block mt-1 text-accent">Kecamatan Purbalingga</span>
                    </h1>

                    <p class="mt-5 text-base sm:text-lg text-white/80 leading-relaxed max-w-2xl mx-auto">
                        Melayani masyarakat dengan sepenuh hati dalam bidang keagamaan, 
                        pernikahan, perwakafan, dan pembinaan keluarga sakinah.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="https://lynk.id/kuapurbalingga" target="_blank" rel="noopener noreferrer"
                           class="px-8 py-3.5 bg-white text-kemenag-dark font-bold text-sm rounded-pill shadow-lg hover:shadow-xl hover:bg-gray-50 transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fa-solid fa-landmark mr-1.5"></i> Akses Layanan Online
                        </a>
                        <a href="#layanan" 
                           class="px-8 py-3.5 bg-white/10 backdrop-blur-sm text-white font-semibold text-sm rounded-pill border border-white/30 hover:bg-white/20 transition-all duration-300">
                            Lihat Layanan Kami
                        </a>
                    </div>
                </div>
            </div>

            <!-- Wave divider -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                    <path d="M0 80L60 74.7C120 69.3 240 58.7 360 53.3C480 48 600 48 720 53.3C840 58.7 960 69.3 1080 69.3C1200 69.3 1320 58.7 1380 53.3L1440 48V80H1380C1320 80 1200 80 1080 80C960 80 840 80 720 80C600 80 480 80 360 80C240 80 120 80 60 80H0Z" fill="#F8FAFC"/>
                </svg>
            </div>
        </section>

        <!-- ============ KUTIPAN AL-QUR'AN ============ -->
        <section class="bg-background py-10 sm:py-14">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="relative bg-white rounded-2xl p-8 sm:p-10 shadow-card border border-gray-100">
                    <!-- Ornamen Kutipan -->
                    <span class="absolute -top-4 left-1/2 -translate-x-1/2 text-5xl text-accent/30 font-serif">"</span>
                    <p class="text-gray-700 text-sm sm:text-base italic leading-relaxed mt-2">
                        "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu 
                        dari (jenis) dirimu sendiri agar kamu merasa tenteram kepadanya."
                    </p>
                    <p class="mt-4 text-accent font-semibold text-sm">QS. Ar-Rum: 21</p>
                </div>
            </div>
        </section>

        <!-- ============ PROGRAM LAYANAN (9 LAYANAN) ============ -->
        <section id="layanan" class="bg-background pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Program Layanan</h2>
                    <p class="mt-2 text-sm text-gray-500">Berbagai layanan keagamaan yang kami sediakan untuk masyarakat</p>
                </div>

                <!-- Grid 9 Layanan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a v-for="(service, index) in services" 
                       :key="index"
                       href="https://lynk.id/kuapurbalingga" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="group bg-white rounded-2xl p-5 shadow-card border border-gray-100 hover:border-kemenag/30 hover:shadow-md transition-all duration-300 flex items-center gap-4"
                    >
                        <!-- Ikon -->
                        <div class="w-12 h-12 bg-kemenag/10 group-hover:bg-kemenag/20 rounded-xl flex items-center justify-center text-xl transition-colors shrink-0">
                            <i :class="[service.icon, 'text-kemenag']"></i>
                        </div>
                        <!-- Text -->
                        <div>
                            <h3 class="font-semibold text-gray-800 text-sm group-hover:text-kemenag transition-colors">{{ service.name }}</h3>
                            <p class="text-xs text-gray-500 mt-0.5">{{ service.desc }}</p>
                        </div>
                        <!-- Arrow -->
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-kemenag ml-auto shrink-0 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- ============ VIDEO PROFIL ============ -->
        <section class="bg-white py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Profil KUA Purbalingga</h2>
                    <p class="mt-2 text-sm text-gray-500">Kenali lebih dekat layanan dan kegiatan kami</p>
                </div>
                <!-- Video YouTube Embed -->
                <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="relative w-full" style="padding-bottom: 56.25%;">
                        <iframe 
                            class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                            title="Profil KUA Kecamatan Purbalingga"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
                <p class="text-center text-xs text-gray-400 mt-3">
                    <!-- Placeholder: Ganti URL video dengan video profil resmi KUA Purbalingga -->
                    Video profil resmi KUA Kecamatan Purbalingga
                </p>
            </div>
        </section>

        <!-- ============ KABAR TERBARU ============ -->
        <section class="bg-background py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Kabar Terbaru</h2>
                        <p class="mt-1 text-sm text-gray-500">Berita dan kegiatan terkini KUA Purbalingga</p>
                    </div>
                    <Link href="/berita-kua" class="hidden sm:inline-flex items-center gap-1 text-sm font-medium text-kemenag hover:text-kemenag-dark transition">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </Link>
                </div>

                <!-- Grid Kartu Berita -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <Link v-for="(post, index) in latestPosts" :key="index" :href="'/kabar/' + post.slug"
                             class="group bg-white rounded-2xl overflow-hidden shadow-card border border-gray-100 hover:shadow-md hover:border-kemenag/20 transition-all duration-300">
                        <!-- Thumbnail -->
                        <div class="h-48 bg-gradient-to-br from-kemenag/10 to-kemenag/5 flex items-center justify-center relative overflow-hidden">
                            <img v-if="post.image_path" :src="'/storage/' + post.image_path" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" :alt="post.title">
                            <svg v-else class="w-16 h-16 text-kemenag/20 relative z-10 transition-transform duration-500 group-hover:scale-105" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <!-- Konten -->
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <span :class="categoryColors[post.category] || 'bg-gray-100 text-gray-600'" class="px-2.5 py-0.5 rounded-full text-xs font-medium">
                                    {{ post.category }}
                                </span>
                                <span class="text-xs text-gray-400">{{ formatDate(post.created_at) }}</span>
                            </div>
                            <h3 class="font-bold text-gray-800 leading-snug group-hover:text-kemenag transition-colors line-clamp-2">
                                {{ post.title }}
                            </h3>
                            <p class="mt-2 text-sm text-gray-500 leading-relaxed line-clamp-2">
                                {{ getExcerpt(post.content) }}
                            </p>
                        </div>
                    </Link>
                </div>

                <!-- Tombol "Lihat Semua" (Mobile) -->
                <div class="mt-8 text-center sm:hidden">
                    <Link href="/berita-kua" class="inline-flex items-center gap-1 px-6 py-3 bg-kemenag hover:bg-kemenag-dark text-white text-sm font-semibold rounded-pill transition shadow-sm">
                        Lihat Semua Kabar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
