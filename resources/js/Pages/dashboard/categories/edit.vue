<template>
    <Layout name="Edit Postingan">
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
                    <label for="name" class="block font-medium">Judul</label>
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

                <input type="hidden" v-model="form.slug" />

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
    categories: Array,
});

const previewUrl = ref(null);

const form = useForm({
    name: props.categories.name,
    slug: props.categories.slug,
});

// const form = useForm({
//     name: props.post?.name || "",
//     slug: props.post?.slug || "",
//     category_id: props.post?.category_id || "",
//     body: props.post?.body || "",
//     image: null,
//     oldImage: props.post?.image || "",
// });

function generateSlug() {
    fetch(`/dashboard/categories/checkSlug?name=${form.name}`)
        .then((res) => res.json())
        .then((data) => {
            form.slug = data.slug;
        });
}

function submitForm() {
    form.put(`/dashboard/categories/${props.categories.slug}`, {
        preserveScroll: true,
        onSuccess: () => {
            console.log("categories updated");
        },
    });
}

//     data: {
//         _method: "put",
//         name: form.name,
//         slug: form.slug,
//         category_id: form.category_id,
//         body: form.body,
//         image: form.image,
//         oldImage: form.oldImage,
//     },
//     forceFormData: true,
//     preserveScroll: true,
//     onSuccess: () => {
//         console.log("categories updated");
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
</script>
