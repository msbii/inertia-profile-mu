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

                <!-- Gambar -->
                <div class="mb-4">
                    <label for="image" class="block font-semibold mb-1"
                        >Gambar Postingan</label
                    >
                    <img
                        v-if="previewUrl"
                        :src="previewUrl"
                        class="img-preview img-fluid mb-3 col-sm-2"
                    />
                    <input
                        type="file"
                        id="image"
                        @change="previewImage"
                        class="w-full border rounded px-3 py-2"
                    />
                    <div
                        v-if="form.errors.image"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.image }}
                    </div>
                </div>

                <!-- Body (Trix Editor) -->
                <div class="mb-4">
                    <label for="body" class="block font-semibold mb-1"
                        >Isi Postingan</label
                    >
                    <input
                        id="body"
                        type="hidden"
                        name="body"
                        v-model="form.body"
                    />
                    <trix-editor
                        input="body"
                        @trix-change="handleTrixChange"
                    ></trix-editor>
                    <div
                        v-if="form.errors.body"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.body }}
                    </div>
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

function handleTrixChange(event) {
    form.body = event.target.innerHTML;
}

const previewUrl = ref(null);
const form = useForm({
    title: "",
    slug: "",
    body: "",
    image: null,
});

function generateSlug() {
    fetch(`/dashboard/sejarah/checkSlug?title=${form.title}`)
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
    form.post("/dashboard/sejarah");
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
