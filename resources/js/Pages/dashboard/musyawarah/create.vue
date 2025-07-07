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
                        >Judul Musyawarah</label
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

                <div class="mb-4">
                    <label for="time" class="form-label"
                        >Tanggal & Waktu Musyawarah</label
                    >
                    <input
                        type="datetime-local"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.time }"
                        id="time"
                        name="time"
                        required
                        autofocus
                        v-model="form.time"
                    />
                    <div v-if="form.errors.time" class="invalid-feedback">
                        {{ form.errors.time }}
                    </div>
                </div>

                <!-- lokasi -->
                <div class="mb-4">
                    <label for="title" class="block font-semibold mb-1"
                        >Lokasi Musyawarah</label
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
                        >Agenda</label
                    >
                    <input
                        id="body"
                        type="hidden"
                        name="body"
                        v-model="form.agenda"
                    />
                    <trix-editor
                        input="agenda"
                        @trix-change="handleAgendaChange"
                    ></trix-editor>
                    <div
                        v-if="form.errors.agenda"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.agenda }}
                    </div>
                </div>
                <!-- Hasil (Trix Editor) -->
                <div class="mb-4">
                    <label for="body" class="block font-semibold mb-1"
                        >Hasil Musyawarah</label
                    >
                    <input
                        id="body"
                        type="hidden"
                        name="body"
                        v-model="form.hasil"
                    />
                    <trix-editor
                        input="hasil"
                        @trix-change="handleHasilChange"
                    ></trix-editor>
                    <div
                        v-if="form.errors.hasil"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.hasil }}
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

const handleAgendaChange = (event) => {
    form.agenda = event.target.innerHTML;
};

const handleHasilChange = (event) => {
    form.hasil = event.target.innerHTML;
};

const previewUrl = ref(null);
const form = useForm({
    title: "",
    slug: "",
    lingkup_id: "",
    image: null,
    time: "",
    location: "",
    agenda: "",
    hasil: "",
});

function generateSlug() {
    fetch(`/dashboard/musyawarah/checkSlug?title=${form.title}`)
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
    form.post("/dashboard/musyawarah");
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
