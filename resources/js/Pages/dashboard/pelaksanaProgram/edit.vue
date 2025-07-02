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
                    <label for="category" class="block font-medium"
                        >Lingkup</label
                    >
                    <select
                        v-model="form.lingkup_id"
                        id="lingkup_id"
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
                    <label for="title" class="block font-medium"
                        >Nama Pelaksana</label
                    >
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="w-full border rounded p-2"
                        :class="{ 'border-red-500': form.errors.name }"
                        @change="generateSlug"
                    />
                    <p v-if="form.errors.name" class="text-red-500 text-sm">
                        {{ form.errors.name }}
                    </p>
                </div>

                <div>
                    <label class="block font-medium mb-1">Description</label>
                    <input
                        id="body"
                        type="hidden"
                        v-model="form.description"
                        name="body"
                    />
                    <trix-editor
                        input="description"
                        @trix-change="updateBody"
                        ref="trixEditorRef"
                    ></trix-editor>
                    <p
                        v-if="form.errors.description"
                        class="text-red-500 text-sm"
                    >
                        {{ form.errors.description }}
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
    title: props.post?.title || "",
    slug: props.post?.slug || "",
    name: props.post?.name || "",
    lingkup_id: props.post?.lingkup_id || "",
    description: props.post?.description || "",
    image: null,
    oldImage: props.post?.image || "",
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
    reader.onload = (e) => {
        previewUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
    console.log("File dipilih:", file);
}

console.log("KIRIM DATA:", {
    title: form.title,
    slug: form.slug,
    name: form.name,
    lingkup_id: form.lingkup_id,
    description: form.description,
    image: form.image,
    oldImage: form.oldImage,
});

function submitForm() {
    console.log("KIRIM:", {
        title: form.title,
        slug: form.slug,
        name: form.name,
        lingkup_id: form.lingkup_id,
        description: form.description,
        image: form.image,
        oldImage: form.oldImage,
    });

    form.submit("post", `/dashboard/sejarah/${props.post.slug}`, {
        data: {
            _method: "put",
            title: form.title,
            slug: form.slug,
            name: form.name,
            lingkup_id: form.lingkup_id,
            description: form.description,
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

// function submitForm() {
//     form.put(`/dashboard/pelaksanaanProgram/${props.post.slug}`, {
//         preserveScroll: true,
//         onSuccess: () => {
//             console.log("Post updated");
//         },
//     });
// }

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
//     onSuccess: () => {
//         console.log("Post updated");
//     },
// });

// function submitForm() {
//     form.put(`/dashboard/posts/${props.post.slug}`, {
//         // method: "putt",
//         // _method: "put", // spoof method agar dianggap PUT
//         forceFormData: true, // wajib agar file ikut terkirim
//         preserveScroll: true,
//         onSuccess: () => {
//             console.log("Post updated");
//         },
//     });
// }

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
    if (hiddenInput && form.description) {
        hiddenInput.value = form.description;

        // Tunggu nextTick agar Trix sudah siap
        setTimeout(() => {
            const editor = trixEditorRef.value?.editor;
            if (editor) {
                editor.loadHTML(form.description); // 🌟 Ini menampilkan konten lama ke editor
            }
        }, 100);
    }
});
</script>
