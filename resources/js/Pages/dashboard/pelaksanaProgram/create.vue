<template>
    <Layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">Cuy</div>
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
                        class="mb-2 w-40 h-auto"
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

                <!-- Lokasi -->
                <div class="mb-4">
                    <label for="category" class="form-label">Lingkup</label>
                    <select
                        class="form-select"
                        v-model="form.lingkup_id"
                        name="lingkup_id"
                    >
                        <option value="" disabled selected>
                            -- Pilih Lingkup --
                        </option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <label for="title" class="block font-semibold mb-1"
                        >Nama Pelaksana</label
                    >
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        @change="generateSlug"
                        class="w-full border rounded px-3 py-2"
                        :class="{ 'border-red-500': form.errors.name }"
                        required
                        autofocus
                    />
                    <div
                        v-if="form.errors.name"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>

                <!-- description (Trix Editor) -->
                <div class="mb-4">
                    <label for="body" class="block font-semibold mb-1"
                        >Isi Postingan</label
                    >
                    <input
                        id="body"
                        type="hidden"
                        name="body"
                        v-model="form.description"
                    />
                    <trix-editor
                        input="description"
                        @trix-change="handleTrixChange"
                    ></trix-editor>
                    <div
                        v-if="form.errors.description"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.description }}
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

const props = defineProps({
    categories: Array,
    post: Array,
});

function handleTrixChange(event) {
    form.description = event.target.innerHTML;
}

const previewUrl = ref(null);
const form = useForm({
    title: "",
    slug: "",
    name: "",
    lingkup_id: "",
    description: "",
    image: null,
});

function generateSlug() {
    fetch(`/dashboard/pelaksanaanProgram/checkSlug?title=${form.title}`)
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
    form.post("/dashboard/pelaksanaanProgram");
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
