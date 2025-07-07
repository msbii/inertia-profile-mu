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
                    <label for="name" class="block font-semibold mb-1"
                        >Judul</label
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

                <!-- Slug (hidden) -->
                <input type="hidden" v-model="form.slug" />

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

const previewUrl = ref(null);
const form = useForm({
    name: "",
    slug: "",
});

function generateSlug() {
    fetch(`/dashboard/categories/checkSlug?name=${form.name}`)
        .then((res) => res.json())
        .then((data) => {
            form.slug = data.slug;
        });
}

function submitForm() {
    form.post("/dashboard/categories");
}
</script>

<style>
@import "trix/dist/trix.css";
</style>
