<template>
    <Layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4"></div>
        </div>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4"></div>
        </div>

        <div class="max-w-3xl mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-4">Buat Postingan Baru</h1>

            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                <!-- Judul -->
                <div class="mb-4">
                    <label for="title" class="block font-semibold mb-1"
                        >Judul</label
                    >
                    <input
                        v-model="form.title"
                        type="text"
                        id="title"
                        @change="generateSlug"
                        class="w-full border rounded px-3 py-2"
                        :class="{ 'border-red-500': form.errors.title }"
                        required
                        autofocus
                    />
                    <div
                        v-if="form.errors.title"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.title }}
                    </div>
                </div>

                <!-- Slug (hidden) -->
                <input type="hidden" v-model="form.slug" />

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="category" class="block font-semibold mb-1"
                        >Kategori</label
                    >
                    <select
                        v-model="form.kategori_sk_id"
                        class="w-full border rounded px-3 py-2"
                    >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tahun" class="block font-semibold mb-1"
                        >Tahun</label
                    >
                    <input
                        v-model="form.tahun"
                        type="text"
                        id="tahun"
                        @change="generateSlug"
                        class="w-full border rounded px-3 py-2"
                        :class="{ 'border-red-500': form.errors.tahun }"
                        required
                        autofocus
                    />
                    <div
                        v-if="form.errors.tahun"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.tahun }}
                    </div>
                </div>

                <!-- Dokumen SK -->
                <div class="mb-4">
                    <label for="document" class="block font-semibold mb-1"
                        >Dokumen SK</label
                    >

                    <input
                        type="file"
                        id="document"
                        @change="handleFileUpload"
                        class="w-full border rounded px-3 py-2"
                    />

                    <div
                        v-if="form.errors.document"
                        class="text-red-500 text-sm mt-1"
                    ></div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">
                    Buat Postingan
                </button>
            </form>
        </div>
    </Layout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import Layout from "@/shared/Admin.vue";

import "trix/dist/trix.css";
import "trix";

import { reactive } from "vue";

const props = defineProps({
    categories: Array,
});

function handleTrixChange(event) {
    form.body = event.target.innerHTML;
}

function handleFileUpload(event) {
    form.document = event.target.files[0];
}

const previewUrl = ref(null);
const form = useForm({
    title: "",
    slug: "",
    kategori_sk_id: "",
    tahun: "",
    document: null,
});

function generateSlug() {
    fetch(`/dashboard/sk/checkSlug?title=${form.title}`)
        .then((res) => res.json())
        .then((data) => {
            form.slug = data.slug;
        });
}

function previewImage(e) {
    const file = e.target.files[0];
    form.image = file;

    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = (e) => {
        previewUrl.value = e.target.result;
    };
}

function submitForm() {
    form.post("/dashboard/sk");
}

// Disable Trix file uploads
onMounted(() => {
    document.addEventListener("trix-file-accept", function (e) {
        e.preventDefault();
    });
});
</script>

<style>
@import "trix/dist/trix.css";
</style>
