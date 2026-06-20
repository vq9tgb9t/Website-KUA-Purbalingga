<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

// Data Struktur Organisasi KUA Kecamatan Purbalingga (data asli dari website resmi)
const kepalaKUA = {
    nama: 'Abdul Latip, S.Ag',
    jabatan: 'Kepala KUA Kecamatan Purbalingga',
    desc: 'Sebagai pimpinan tertinggi di lingkungan KUA Kecamatan Purbalingga, Kepala KUA memimpin seluruh unit kerja dan bertanggung jawab atas pelaksanaan layanan keagamaan, administrasi, serta pembinaan masyarakat.',
};

const tataUsaha = {
    nama: 'Zidni Mukoronah',
    jabatan: 'Tata Usaha',
    desc: 'Menangani pengelolaan administrasi internal, surat-menyurat, penyusunan laporan, dan membantu koordinasi kegiatan di lingkungan KUA.',
};

const penghulu = [
    { nama: 'Abdul Latip, S.Ag' },
    { nama: 'Izzuthoriqulhaq, S.Ag' },
    { nama: 'Syafiq Ni\'ami, S.Ag' },
];

const penyuluh = [
    { nama: 'Sudirman, S.Kom.I' },
    { nama: 'Siti Suwarti, S.Ag' },
    { nama: 'Sri Agustianingsih, S.Kom.I' },
    { nama: 'Arin Hidayat, S.H.I' },
];

const operatorLayanan = {
    nama: 'Miftakhur Rohmah, S.Ag',
    jabatan: 'Operator Layanan Operasional',
    desc: 'Bertugas mengelola data dan layanan administrasi berbasis digital serta mendukung kelancaran operasional kantor.',
};

const pengadministrasi = [
    { nama: 'Masdarudin Akhmad' },
    { nama: 'Agus Mustaqim' },
];

const penjagaMalam = {
    nama: 'Supono',
    jabatan: 'Penjaga Malam',
    desc: 'Menjaga keamanan lingkungan kantor di luar jam operasional dan memastikan fasilitas kantor tetap terjaga.',
};
</script>

<template>
    <Head title="Struktur Organisasi" />
    <MainLayout>
        <!-- ============ HERO ============ -->
        <section class="relative overflow-hidden bg-gradient-to-br from-kemenag-dark via-kemenag to-kemenag-light py-16 sm:py-24">
            <div class="absolute inset-0 opacity-[0.07]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight">
                    Struktur Organisasi
                </h1>
                <p class="mt-5 text-base sm:text-lg text-white/80 leading-relaxed max-w-2xl mx-auto">
                    Untuk menunjang efektivitas pelayanan publik di bidang keagamaan, KUA Kecamatan Purbalingga 
                    menerapkan struktur organisasi yang rapi dan fungsional.
                </p>
            </div>
            <!-- Wave divider -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                    <path d="M0 80L60 74.7C120 69.3 240 58.7 360 53.3C480 48 600 48 720 53.3C840 58.7 960 69.3 1080 69.3C1200 69.3 1320 58.7 1380 53.3L1440 48V80H1380C1320 80 1200 80 1080 80C960 80 840 80 720 80C600 80 480 80 360 80C240 80 120 80 60 80H0Z" fill="#F8FAFC"/>
                </svg>
            </div>
        </section>

        <!-- ============ KEPALA KUA ============ -->
        <section class="bg-background py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Pimpinan</h2>
                    <p class="mt-2 text-sm text-gray-500">Kepala Kantor Urusan Agama Kecamatan Purbalingga</p>
                </div>

                <!-- Kartu Kepala KUA -->
                <div class="max-w-md mx-auto">
                    <div class="bg-white rounded-2xl shadow-card border border-gray-100 overflow-hidden text-center relative">
                        <div class="h-2 bg-gradient-to-r from-kemenag to-kemenag-light"></div>
                        <div class="p-8">
                            <!-- Avatar Placeholder -->
                            <div class="w-28 h-28 mx-auto bg-gradient-to-br from-kemenag/20 to-kemenag/10 rounded-full flex items-center justify-center mb-5 ring-4 ring-kemenag/10">
                                <svg class="w-14 h-14 text-kemenag/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ kepalaKUA.nama }}</h3>
                            <p class="text-kemenag font-semibold text-sm mt-2">{{ kepalaKUA.jabatan }}</p>
                            <p class="text-gray-500 text-sm mt-4 leading-relaxed">{{ kepalaKUA.desc }}</p>
                        </div>
                    </div>
                </div>

                <!-- Garis penghubung vertikal -->
                <div class="flex justify-center my-6">
                    <div class="w-0.5 h-12 bg-gray-200"></div>
                </div>

                <!-- Tata Usaha -->
                <div class="max-w-md mx-auto">
                    <div class="bg-white rounded-2xl shadow-card border border-gray-100 overflow-hidden text-center">
                        <div class="h-1.5 bg-gradient-to-r from-blue-400 to-blue-500"></div>
                        <div class="p-6">
                            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">{{ tataUsaha.nama }}</h3>
                            <p class="text-blue-600 font-semibold text-sm mt-1">{{ tataUsaha.jabatan }}</p>
                            <p class="text-gray-500 text-sm mt-3 leading-relaxed">{{ tataUsaha.desc }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ PENGHULU ============ -->
        <section class="bg-white py-12 sm:py-16">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-kemenag/10 rounded-full text-kemenag text-xs font-semibold mb-4">
                        <i class="fa-solid fa-ring"></i> Pelayanan Nikah & Rujuk
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Penghulu</h2>
                    <p class="mt-2 text-sm text-gray-500 max-w-xl mx-auto">
                        Penghulu bertugas memimpin prosesi akad nikah serta memberikan bimbingan dan edukasi kepada calon pengantin.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl mx-auto">
                    <div v-for="(person, index) in penghulu" :key="index"
                         class="group bg-gray-50 hover:bg-white rounded-2xl p-6 border border-gray-100 hover:border-kemenag/20 hover:shadow-lg text-center transition-all duration-300">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-full flex items-center justify-center mb-4 group-hover:ring-4 ring-kemenag/10 transition-all">
                            <svg class="w-10 h-10 text-kemenag/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm leading-snug">{{ person.nama }}</h3>
                        <p class="text-kemenag text-xs font-semibold mt-1.5">Penghulu</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ PENYULUH AGAMA ISLAM ============ -->
        <section class="bg-background py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-amber-100 rounded-full text-amber-700 text-xs font-semibold mb-4">
                        <i class="fa-solid fa-book-open"></i> Dakwah & Pembinaan Umat
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Penyuluh Agama Islam</h2>
                    <p class="mt-2 text-sm text-gray-500 max-w-xl mx-auto">
                        Penyuluh memiliki peran penting dalam menyampaikan dakwah, pendidikan keagamaan, serta pembinaan umat di tengah masyarakat.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="(person, index) in penyuluh" :key="index"
                         class="group bg-white hover:bg-white rounded-2xl p-6 border border-gray-100 hover:border-amber-300/50 hover:shadow-lg text-center transition-all duration-300">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-amber-100 to-amber-50 rounded-full flex items-center justify-center mb-4 group-hover:ring-4 ring-amber-200/50 transition-all">
                            <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm leading-snug">{{ person.nama }}</h3>
                        <p class="text-amber-600 text-xs font-semibold mt-1.5">Penyuluh Agama Islam</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ STAF PENDUKUNG ============ -->
        <section class="bg-white py-12 sm:py-16">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-100 rounded-full text-blue-700 text-xs font-semibold mb-4">
                        <i class="fa-solid fa-gears"></i> Operasional & Administrasi
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Staf Pendukung</h2>
                    <p class="mt-2 text-sm text-gray-500 max-w-xl mx-auto">
                        Petugas yang mendukung kelancaran operasional dan administrasi kantor.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Operator Layanan Operasional -->
                    <div class="group bg-gray-50 hover:bg-white rounded-2xl p-6 border border-gray-100 hover:border-blue-200 hover:shadow-lg text-center transition-all duration-300">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center mb-4 group-hover:ring-4 ring-blue-100 transition-all">
                            <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm leading-snug">{{ operatorLayanan.nama }}</h3>
                        <p class="text-blue-600 text-xs font-semibold mt-1.5">{{ operatorLayanan.jabatan }}</p>
                        <p class="text-gray-500 text-xs mt-3 leading-relaxed">{{ operatorLayanan.desc }}</p>
                    </div>

                    <!-- Pengadministrasi Perkantoran -->
                    <div v-for="(person, index) in pengadministrasi" :key="index"
                         class="group bg-gray-50 hover:bg-white rounded-2xl p-6 border border-gray-100 hover:border-blue-200 hover:shadow-lg text-center transition-all duration-300">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center mb-4 group-hover:ring-4 ring-blue-100 transition-all">
                            <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm leading-snug">{{ person.nama }}</h3>
                        <p class="text-blue-600 text-xs font-semibold mt-1.5">Pengadministrasi Perkantoran</p>
                    </div>
                </div>

                <!-- Penjaga Malam -->
                <div class="mt-8 max-w-sm mx-auto">
                    <div class="group bg-gray-50 hover:bg-white rounded-2xl p-6 border border-gray-100 hover:border-gray-300 hover:shadow-lg text-center transition-all duration-300">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-gray-200 to-gray-100 rounded-full flex items-center justify-center mb-4 group-hover:ring-4 ring-gray-200 transition-all">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-sm leading-snug">{{ penjagaMalam.nama }}</h3>
                        <p class="text-gray-500 text-xs font-semibold mt-1.5">{{ penjagaMalam.jabatan }}</p>
                        <p class="text-gray-500 text-xs mt-3 leading-relaxed">{{ penjagaMalam.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ PENUTUP ============ -->
        <section class="bg-background py-12 sm:py-16">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-white rounded-2xl p-8 shadow-card border border-gray-100">
                    <p class="text-gray-600 text-sm leading-relaxed italic">
                        "Struktur organisasi ini mencerminkan komitmen KUA Kecamatan Purbalingga dalam memberikan 
                        pelayanan yang profesional, akuntabel, dan responsif terhadap kebutuhan masyarakat. Dengan 
                        sinergi yang kuat di antara seluruh unsur organisasi, KUA terus berupaya meningkatkan mutu 
                        layanan keagamaan secara berkelanjutan."
                    </p>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
