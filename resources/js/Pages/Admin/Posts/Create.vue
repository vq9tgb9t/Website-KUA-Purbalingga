<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const form = useForm({
    title: '',
    category: 'Berita KUA',
    content: '',
    image: null,
});

const toolbarOptions = [
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    ['bold', 'italic', 'underline'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'align': [] }]
];

const submit = () => {
    form.post(route('admin.posts.store'));
};

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (!file) {
        form.image = null;
        return;
    }

    if (!file.type.startsWith('image/')) {
        form.image = file;
        return;
    }

    // Kompresi di browser (Client-side)
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = (e) => {
        const img = new Image();
        img.src = e.target.result;
        img.onload = () => {
            const canvas = document.createElement('canvas');
            const MAX_WIDTH = 1200;
            let width = img.width;
            let height = img.height;

            if (width > MAX_WIDTH) {
                height = Math.round((height * MAX_WIDTH) / width);
                width = MAX_WIDTH;
            }

            canvas.width = width;
            canvas.height = height;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, width, height);

            canvas.toBlob((blob) => {
                const newFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".webp", {
                    type: "image/webp",
                    lastModified: Date.now()
                });
                form.image = newFile;
            }, 'image/webp', 0.8);
        };
    };
};

const addTooltips = () => {
    const tooltips = {
        '.ql-bold': 'Bold (Ctrl+B)',
        '.ql-italic': 'Italic (Ctrl+I)',
        '.ql-underline': 'Underline (Ctrl+U)',
        '.ql-strike': 'Strikethrough',
        '.ql-header': 'Heading',
        '.ql-list[value="ordered"]': 'Numbered List',
        '.ql-list[value="bullet"]': 'Bulleted List',
        '.ql-indent[value="-1"]': 'Decrease Indent',
        '.ql-indent[value="+1"]': 'Increase Indent',
        '.ql-link': 'Insert Link',
        '.ql-image': 'Insert Image',
        '.ql-video': 'Insert Video',
        '.ql-clean': 'Clear Formatting',
        '.ql-align': 'Text Align',
        '.ql-color': 'Text Color',
        '.ql-background': 'Background Color'
    };

    // Quill takes a moment to inject its toolbar
    setTimeout(() => {
        for (const [selector, title] of Object.entries(tooltips)) {
            const elements = document.querySelectorAll(selector);
            elements.forEach(el => {
                el.setAttribute('title', title);
            });
        }
    }, 100);
};
</script>

<template>
    <Head title="Tambah Post" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link :href="route('dashboard')" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </Link>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Tambah Berita/Artikel Baru
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <form @submit.prevent="submit" class="p-4 sm:p-8 space-y-6">
                        
                        <!-- Judul -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Post</label>
                            <input v-model="form.title" type="text" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kemenag focus:ring-kemenag">
                            <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select v-model="form.category" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-kemenag focus:ring-kemenag">
                                <option value="Berita KUA">Berita KUA</option>
                                <option value="Urab Mendoan">Urab Mendoan</option>
                                <option value="Artikel">Artikel</option>
                            </select>
                            <div v-if="form.errors.category" class="text-red-500 text-sm mt-1">{{ form.errors.category }}</div>
                        </div>

                        <!-- Konten -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Isi Konten</label>
                            <div class="bg-white rounded-md border border-gray-300 shadow-sm focus-within:border-kemenag focus-within:ring-1 focus-within:ring-kemenag overflow-hidden">
                                <QuillEditor 
                                    theme="snow" 
                                    v-model:content="form.content" 
                                    contentType="html" 
                                    :toolbar="toolbarOptions"
                                    @ready="addTooltips"
                                    class="min-h-[300px]" 
                                />
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Gunakan editor di atas untuk menebalkan teks, membuat daftar, atau memformat paragraf.</p>
                            <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</div>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar (Opsional)</label>
                            <input type="file" @change="handleImageUpload" accept="image/*" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-kemenag/10 file:text-kemenag hover:file:bg-kemenag/20">
                            <p class="text-xs text-gray-500 mt-1">Ukuran berapapun dibolehkan. Browser Anda akan mengompresnya secara otomatis sebelum di-upload.</p>
                            <div v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</div>
                        </div>

                        <!-- Tombol -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <Link :href="route('dashboard')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                                Batal
                            </Link>
                            <button type="submit" :disabled="form.processing" class="px-6 py-2 text-sm font-medium text-white bg-kemenag rounded-md hover:bg-kemenag-dark transition disabled:opacity-50">
                                Simpan Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
/* Memaksa editor Quill agar area tulisannya memenuhi kotak penuh, sehingga bisa diklik di mana saja */
.ql-container.ql-snow {
    display: flex;
    flex-direction: column;
}
.ql-editor {
    min-height: 300px;
    flex: 1;
}
</style>
