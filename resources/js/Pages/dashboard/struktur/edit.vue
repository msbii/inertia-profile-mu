<script setup>
import Layout from "@/shared/Admin.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

import "trix";
import "trix/dist/trix.css";

const props = defineProps({
    post: Object,
    categories: Array,
});

const previewUrl = ref(null);

const form = useForm({
    title: props.post.title,
    slug: props.post.slug,
    kategori_id: props.post.kategori_id,
    image: null, // File baru
    oldImage: props.post.image, // Gambar lama
});

function submitForm() {
    console.log("KIRIM:", {
        title: form.title,
        slug: form.slug,
        kategori_id: form.kategori_id,
        image: form.image,
        oldImage: form.oldImage,
    });

    form.submit("post", `/dashboard/struktur/${props.post.slug}`, {
        data: {
            _method: "put",
            title: form.title,
            slug: form.slug,
            kategori_id: form.kategori_id,
            image: form.image,
            oldImage: form.oldImage,
        },
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            console.log("✅ Post updated!");
        },
        onError: (errors) => {
            console.error("❌ Gagal update:", errors);
        },
    });
}

// form.submit("post", `/dashboard/posts/${props.post.slug}`, {
//     data: {
//         _method: "put",
//         title: form.title,
//         slug: form.slug,
//         category_id: form.category_id,
//         body: form.body,
//         image: form.image,
//         oldImage: form.oldImage,
//     },
//     forceFormData: true,
//     preserveScroll: true,
// });

function previewImage(e) {
    const file = e.target.files[0];
    form.image = file;

    const reader = new FileReader();
    reader.onload = (e) => {
        previewUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
}
</script>

<template>
    <Layout title="Edit Postingan">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">Cuy</div>
        </div>

        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-semibold mb-6">Ubah Postingan</h1>
            <form
                @submit.prevent="submitForm"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                <div>
                    <label for="title" class="block font-medium">Judul</label>
                    <input
                        v-model="form.title"
                        type="text"
                        id="title"
                        class="w-full border rounded p-2"
                        :class="{ 'border-red-500': form.errors.title }"
                        @change="generateSlug"
                    />
                    <p v-if="form.errors.title" class="text-red-500 text-sm">
                        {{ form.errors.title }}
                    </p>
                </div>

                <input type="hidden" v-model="form.slug" />

                <div>
                    <label for="category_id" class="block font-medium"
                        >Kategori</label
                    >
                    <select
                        v-model="form.kategori_id"
                        id="kategori_id"
                        class="w-full border rounded p-2"
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

                <div>
                    <label for="image" class="block font-medium">Gambar</label>
                    <input type="file" @change="previewImage" />
                    <img
                        v-if="previewUrl"
                        :src="previewUrl"
                        class="img-preview img-fluid mb-3 col-sm-2"
                    />
                    <img
                        v-else-if="form.oldImage"
                        :src="`/storage/${form.oldImage}`"
                        class="img-preview img-fluid mb-3 col-sm-2"
                    />
                    <!-- <input
                        type="hidden"
                        name="oldImage"
                        :value="form.oldImage"
                    /> -->
                </div>

                <!-- <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded"
                >
                    Perbarui Postingan
                </button> -->
                <!-- Submit -->
                <button type="submit" class="btn btn-primary">
                    perbarui Postingan
                </button>
            </form>
        </div>
    </Layout>
</template>
