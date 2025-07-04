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

// const form = useForm({
//     title: props.post.title,
//     slug: props.post.slug,
//     category_id: props.post.category_id,
//     body: props.post.body,
//     image: null, // File baru
//     oldImage: props.post.image, // Gambar lama
// });

const form = useForm({
    title: props.post?.title || "",
    slug: props.post?.slug || "",
    category_id: props.post?.category_id || "",
    body: props.post?.body || "",
    image: null,
    oldImage: props.post?.image || "",
});

function generateSlug() {
    fetch(`/dashboard/posts/checkSlug?title=${form.title}`)
        .then((res) => res.json())
        .then((data) => {
            form.slug = data.slug;
        });
}

function previewImage(e) {
    const file = e.target.files[0];
    form.image = file;

    const reader = new FileReader();
    reader.onload = (e) => {
        previewUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
}

function submitForm() {
    console.log("KIRIM:", {
        title: form.title,
        slug: form.slug,
        category_id: form.category_id,
        body: form.body,
        image: form.image,
        oldImage: form.oldImage,
    });

    form.submit("post", `/dashboard/posts/${props.post.slug}`, {
        data: {
            _method: "put",
            title: form.title,
            slug: form.slug,
            category_id: form.category_id,
            body: form.body,
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

const trixEditorRef = ref(null);

function updateBody(e) {
    form.body = e.target.innerHTML;
}

onMounted(() => {
    document.addEventListener("trix-file-accept", (e) => e.preventDefault());

    setTimeout(() => {
        const editor = trixEditorRef.value?.editor;
        if (editor && form.body) {
            editor.loadHTML(form.body);
        }
    }, 100);
});
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
                        v-model="form.category_id"
                        id="category_id"
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

                <div>
                    <label class="block font-medium mb-1">Isi Postingan</label>
                    <input
                        id="body"
                        type="hidden"
                        v-model="form.body"
                        name="body"
                    />
                    <trix-editor
                        input="body"
                        @trix-change="updateBody"
                        ref="trixEditorRef"
                    ></trix-editor>
                    <p v-if="form.errors.body" class="text-red-500 text-sm">
                        {{ form.errors.body }}
                    </p>
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
