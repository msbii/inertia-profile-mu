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

                <!-- Quantity -->
                <div class="mb-4">
                    <label for="title" class="block font-semibold mb-1"
                        >Quantity</label
                    >
                    <input
                        v-model="form.quantity"
                        type="text"
                        id="quantity"
                        @change="generateSlug"
                        class="w-full border rounded px-3 py-2"
                        :class="{ 'border-red-500': form.errors.quantity }"
                        required
                        autofocus
                    />
                    <div
                        v-if="form.errors.quantity"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.quantity }}
                    </div>
                </div>
                <!-- Lokasi -->
                <div class="mb-4">
                    <label for="category" class="form-label">Lokasi</label>
                    <select
                        class="form-select"
                        v-model="form.location_id"
                        name="location_id"
                    >
                        <option value="" disabled selected>
                            -- Pilih Lokasi --
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
                <!-- Lokasi -->
                <div class="mb-4">
                    <label for="title" class="block font-semibold mb-1"
                        >Detail Lokasi</label
                    >
                    <input
                        v-model="form.location"
                        type="text"
                        id="location"
                        @change="generateSlug"
                        class="w-full border rounded px-3 py-2"
                        :class="{ 'border-red-500': form.errors.location }"
                        required
                        autofocus
                    />
                    <div
                        v-if="form.errors.location"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.location }}
                    </div>
                </div>

                <!-- description (Trix Editor) -->
                <div class="mb-4">
                    <label for="body" class="block font-semibold mb-1"
                        >Deskripsi</label
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
});

function handleTrixChange(event) {
    form.description = event.target.innerHTML;
}

const previewUrl = ref(null);
const form = useForm({
    title: "",
    slug: "",
    quantity: "",
    location: "",
    description: "",
    location_id: "",
    image: null,
});

function generateSlug() {
    fetch(`/dashboard/inventaris/checkSlug?title=${form.title}`)
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
    form.post("/dashboard/inventaris");
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
