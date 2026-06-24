<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

const visiMisi = {
    visi: 'Terwujudnya masyarakat Kecamatan Purbalingga yang taat beragama, rukun, cerdas, mandiri, dan sejahtera lahir batin.',
    misi: [
        'Meningkatkan kualitas pelayanan nikah dan rujuk yang profesional, transparan, dan akuntabel.',
        'Meningkatkan pembinaan keluarga sakinah di masyarakat.',
        'Meningkatkan pembinaan dan pelayanan di bidang perwakafan.',
        'Meningkatkan kualitas pembinaan lembaga keagamaan Islam (masjid, mushalla, madrasah diniyah, dan majelis taklim).',
        'Meningkatkan kemitraan umat dan kerukunan antar umat beragama.',
    ]
};

const tugasFungsi = [
    {
        title: 'Pelaksanaan Pelayanan Nikah & Rujuk',
        desc: 'Melaksanakan pencatatan, pelayanan administrasi, dan bimbingan pernikahan serta rujuk sesuai ketentuan yang berlaku.',
        icon: 'fa-solid fa-ring',
    },
    {
        title: 'Pembinaan Keluarga Sakinah',
        desc: 'Memberikan bimbingan dan konseling pra-nikah, pembinaan keluarga sakinah, serta mediasi konflik rumah tangga.',
        icon: 'fa-solid fa-people-roof',
    },
    {
        title: 'Pelayanan Perwakafan',
        desc: 'Melaksanakan pendataan, pencatatan, dan pengawasan tanah wakaf serta pembinaan nazir wakaf.',
        icon: 'fa-solid fa-mosque',
    },
    {
        title: 'Pembinaan Lembaga Keagamaan',
        desc: 'Melakukan pembinaan terhadap masjid, mushalla, madrasah diniyah, dan majelis taklim di wilayah kecamatan.',
        icon: 'fa-solid fa-book-open',
    },
    {
        title: 'Bimbingan Manasik Haji',
        desc: 'Menyelenggarakan bimbingan manasik haji bagi calon jamaah haji di tingkat kecamatan.',
        icon: 'fa-solid fa-kaaba',
    },
    {
        title: 'Kerukunan Umat Beragama',
        desc: 'Memfasilitasi dialog dan kerjasama antar umat beragama untuk menjaga keharmonisan di masyarakat.',
        icon: 'fa-solid fa-handshake',
    },
];

const infoKantor = {
    alamat: 'Jl. Wiraguna, Purbalingga Kidul, Purbalingga, Purbalingga Regency, Central Java 53313',
    telepon: '(62) 813-2783-9191',
    email: 'kuakcpurbalingga@gmail.com',
    jamOperasional: 'Senin – Jumat, 07.30 – 16.00 WIB',
};
</script>

<template>
    <Head title="Profil KUA" />
    <MainLayout>
        <!-- ============ HERO PROFIL ============ -->
        <section class="relative bg-gradient-to-br from-kemenag-dark via-kemenag to-kemenag-light py-16 sm:py-24">
            <div class="absolute inset-0 opacity-[0.07]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/15 backdrop-blur-sm rounded-full text-white/90 text-xs font-medium mb-6 border border-white/20">
                    <span class="w-2 h-2 bg-accent rounded-full"></span>
                    Kementerian Agama RI
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight">
                    Profil KUA
                    <span class="block mt-1 text-accent">Kecamatan Purbalingga</span>
                </h1>
                <p class="mt-5 text-base sm:text-lg text-white/80 leading-relaxed max-w-2xl mx-auto">
                    Kantor Urusan Agama (KUA) Kecamatan Purbalingga merupakan unit pelaksana teknis Kementerian Agama 
                    yang bertugas melaksanakan sebagian tugas Kantor Kementerian Agama Kabupaten Purbalingga di bidang urusan agama Islam.
                </p>
            </div>
            <!-- Wave divider -->
            <div class="absolute bottom-[-2px] left-0 right-0 z-10">
                <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full block translate-y-[1px]">
                    <path d="M0 80L60 74.7C120 69.3 240 58.7 360 53.3C480 48 600 48 720 53.3C840 58.7 960 69.3 1080 69.3C1200 69.3 1320 58.7 1380 53.3L1440 48V80H1380C1320 80 1200 80 1080 80C960 80 840 80 720 80C600 80 480 80 360 80C240 80 120 80 60 80H0Z" fill="#F8FAFC"/>
                </svg>
            </div>
        </section>

        <!-- ============ VISI & MISI ============ -->
        <section class="bg-background py-16 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <!-- Visi -->
                    <div class="bg-white rounded-2xl p-8 sm:p-10 shadow-card border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-kemenag to-kemenag-light"></div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-kemenag/10 rounded-xl flex items-center justify-center text-xl">
                                <i class="fa-solid fa-bullseye text-kemenag"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Visi</h2>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-base italic border-l-4 border-kemenag/30 pl-5">
                            "{{ visiMisi.visi }}"
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="bg-white rounded-2xl p-8 sm:p-10 shadow-card border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-accent to-amber-400"></div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center text-xl">
                                <i class="fa-solid fa-rocket text-accent"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Misi</h2>
                        </div>
                        <ol class="space-y-4">
                            <li v-for="(misi, index) in visiMisi.misi" :key="index" class="flex items-start gap-4">
                                <span class="flex-shrink-0 w-8 h-8 bg-kemenag/10 text-kemenag font-bold text-sm rounded-lg flex items-center justify-center mt-0.5">
                                    {{ index + 1 }}
                                </span>
                                <p class="text-gray-700 leading-relaxed text-sm">{{ misi }}</p>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ TUGAS & FUNGSI ============ -->
        <section class="bg-white py-16 sm:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Tugas & Fungsi</h2>
                    <p class="mt-3 text-base text-gray-500 max-w-2xl mx-auto">
                        Bidang-bidang pelayanan dan pembinaan yang menjadi tanggung jawab KUA Kecamatan Purbalingga.
                    </p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="(item, index) in tugasFungsi" :key="index"
                         class="group bg-gray-50 hover:bg-white rounded-2xl p-6 border border-gray-100 hover:border-kemenag/20 hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 bg-kemenag/10 group-hover:bg-kemenag/15 rounded-xl flex items-center justify-center text-2xl mb-5 transition-colors">
                            <i :class="[item.icon, 'text-kemenag']"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg mb-2 group-hover:text-kemenag transition-colors">{{ item.title }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ item.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ INFORMASI KANTOR ============ -->
        <section class="bg-background py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Informasi Kantor</h2>
                    <p class="mt-2 text-sm text-gray-500">Hubungi kami untuk informasi lebih lanjut</p>
                </div>
                <div class="bg-gray-100 rounded-2xl shadow-card border border-gray-100 overflow-hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-px">
                        <!-- Alamat -->
                        <div class="p-6 sm:p-8 flex items-start gap-4 bg-white">
                            <div class="w-10 h-10 bg-kemenag/10 rounded-lg flex items-center justify-center text-base flex-shrink-0">
                                <i class="fa-solid fa-location-dot text-kemenag"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Alamat</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ infoKantor.alamat }}</p>
                            </div>
                        </div>
                        <!-- Jam Operasional -->
                        <div class="p-6 sm:p-8 flex items-start gap-4 bg-white">
                            <div class="w-10 h-10 bg-kemenag/10 rounded-lg flex items-center justify-center text-base flex-shrink-0">
                                <i class="fa-solid fa-clock text-kemenag"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Jam Operasional</h4>
                                <p class="text-gray-600 text-sm">{{ infoKantor.jamOperasional }}</p>
                                <p class="text-gray-400 text-xs mt-1">Sabtu & Minggu tutup</p>
                            </div>
                        </div>
                        <!-- Telepon -->
                        <div class="p-6 sm:p-8 flex items-start gap-4 bg-white">
                            <div class="w-10 h-10 bg-kemenag/10 rounded-lg flex items-center justify-center text-base flex-shrink-0">
                                <i class="fa-solid fa-phone text-kemenag"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Telepon</h4>
                                <p class="text-gray-600 text-sm">{{ infoKantor.telepon }}</p>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="p-6 sm:p-8 flex items-start gap-4 bg-white">
                            <div class="w-10 h-10 bg-kemenag/10 rounded-lg flex items-center justify-center text-base flex-shrink-0">
                                <i class="fa-solid fa-envelope text-kemenag"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Email</h4>
                                <p class="text-gray-600 text-sm">{{ infoKantor.email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ PETA LOKASI ============ -->
        <section class="bg-white py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Lokasi Kami</h2>
                    <p class="mt-2 text-sm text-gray-500">Temukan kantor KUA Kecamatan Purbalingga</p>
                </div>
                <div class="rounded-2xl overflow-hidden shadow-card border border-gray-100">
                    <iframe 
                        src="https://maps.google.com/maps?q=Jl.%20Wiraguna,%20Purbalingga%20Kidul,%20Purbalingga,%20Purbalingga%20Regency,%20Central%20Java%2053313&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi KUA Kecamatan Purbalingga"
                    ></iframe>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
