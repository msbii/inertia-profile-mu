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
                        v-else-if="form.oldImage"
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
                    ></div>
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

// function handleFileUpload(event) {
//     form.document = event.target.files[0];
// }

function previewDocument(e) {
    const file = e.target.files[0];
    form.image = file;

    const reader = new FileReader();
    reader.onload = (e) => {
        previewUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
    console.log("File dipilih:", file);
}

const form = useForm({
    title: props.post?.title || "",
    slug: props.post?.slug || "",
    kategori_sk_id: props.post?.kategori_sk_id || "",
    tahun: props.post?.tahun || "",
    document: null,
    olddocument: props.post?.document || "",
});

function generateSlug() {
    fetch(`/dashboard/sk/checkSlug?title=${form.title}`)
        .then((res) => res.json())
        .then((data) => {
            form.slug = data.slug;
        });
}

console.log("KIRIM DATA:", {
    title: form.title,
    slug: form.slug,
    kategori_sk_id: form.kategori_sk_id,
    tahun: form.tahun,
    document: form.document,
    olddocument: form.olddocument,
});

function submitForm() {
    console.log("KIRIM:", {
        title: form.title,
        slug: form.slug,
        kategori_sk_id: form.kategori_sk_id,
        tahun: form.tahun,
        document: form.document,
        olddocument: form.olddocument,
    });

    form.submit("post", `/dashboard/sk/${props.post.slug}`, {
        data: {
            _method: "put",
            title: form.title,
            slug: form.slug,
            kategori_sk_id: form.kategori_sk_id,
            tahun: form.tahun,
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
</script>
