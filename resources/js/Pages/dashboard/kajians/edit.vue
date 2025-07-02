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
                    <label for="speaker" class="block font-medium"
                        >Speaker</label
                    >
                    <input
                        v-model="form.speaker"
                        type="text"
                        id="speaker"
                        class="w-full border rounded p-2"
                        :class="{ 'border-red-500': form.errors.speaker }"
                        @change="generateSlug"
                    />
                    <p v-if="form.errors.speaker" class="text-red-500 text-sm">
                        {{ form.errors.speaker }}
                    </p>
                </div>

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
                        class="w-32 mt-2 rounded"
                    />
                    <img
                        v-else-if="form.oldImage"
                        :src="`/storage/${form.oldImage}`"
                        class="w-32 mt-2 rounded"
                    />
                    <input
                        type="hidden"
                        name="oldImage"
                        :value="form.oldImage"
                    />
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

                <!-- Dokumen -->
                <div class="mb-4">
                    <label for="document" class="block font-semibold mb-1"
                        >Dokumen Kajian</label
                    >
                    <input
                        type="file"
                        id="document"
                        @change="previewDocument"
                        class="w-full border rounded px-3 py-2"
                    />
                    <!-- Preview Dokumen -->
                    <iframe
                        v-if="previewUrl"
                        :src="previewUrl"
                        width="50%"
                        height="300px"
                        style="border: none"
                    ></iframe>
                    <iframe
                        v-else-if="form.olddocument"
                        :src="`/storage/post-document/${form.olddocument}`"
                        width="50%"
                        height="300px"
                        style="border: none"
                    ></iframe>
                    <input
                        type="hidden"
                        name="olddocument"
                        :value="form.olddocument"
                    />
                    <div
                        v-if="form.errors.document"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.document }}
                    </div>
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

<script setup>
import Layout from "@/shared/Admin.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import "trix";
import "trix/dist/trix.css";

const props = defineProps({
    post: Object,
    categories: Object,
});

const previewUrl = ref(null);

const form = useForm({
    title: props.post?.title || "",
    slug: props.post?.slug || "",
    speaker: props.post?.speaker || "",
    category_id: props.post?.category_id || "",
    body: props.post?.body || "",
    image: null,
    oldImage: props.post?.image || "",
    document: null,
    olddocument: props.post?.document || "",
});

function generateSlug() {
    fetch(`/dashboard/kajian/checkSlug?title=${form.title}`)
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
    console.log("File dipilih:", file);
}

function previewDocument(e) {
    const file = e.target.files[0];
    form.document = file;

    const reader = new FileReader();
    reader.onload = (e) => {
        previewUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
    console.log("File dipilih:", file);
}

console.log("KIRIM DATA:", {
    title: form.title,
    slug: form.slug,
    speaker: form.speaker,
    category_id: form.category_id,
    body: form.body,
    image: form.image,
    oldImage: form.oldImage,
    document: form.document,
    olddocument: form.olddocument,
});

// Kirim form update
function submitForm() {
    console.log("KIRIM:", {
        title: form.title,
        slug: form.slug,
        speaker: form.speaker,
        category_id: form.category_id,
        body: form.body,
        image: form.image,
        oldImage: form.oldImage,
        document: form.document,
        olddocument: form.olddocument,
    });

    form.submit("post", `/dashboard/kajian/${props.post.slug}`, {
        data: {
            _method: "put",
            title: form.title,
            slug: form.slug,
            speaker: form.speaker,
            category_id: form.category_id,
            body: form.body,
            image: form.image,
            oldImage: form.oldImage,
            document: form.document,
            olddocument: form.olddocument,
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

// Refs
const trixEditorRef = ref(null);

function updateBody(e) {
    form.body = e.target.innerHTML;
}

// Set isi trix-editor secara manual
onMounted(() => {
    document.addEventListener("trix-file-accept", (e) => e.preventDefault());

    // Ini akan memastikan input hidden sudah terisi duluan
    // document.querySelector("#body").value = form.body;

    // Ini memastikan nilai input hidden sudah ada
    const hiddenInput = document.querySelector("#body");
    if (hiddenInput && form.body) {
        hiddenInput.value = form.body;

        // Tunggu nextTick agar Trix sudah siap
        setTimeout(() => {
            const editor = trixEditorRef.value?.editor;
            if (editor) {
                editor.loadHTML(form.body); // 🌟 Ini menampilkan konten lama ke editor
            }
        }, 100);
    }
});
</script>
