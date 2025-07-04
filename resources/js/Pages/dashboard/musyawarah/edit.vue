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
                        class="img-preview img-fluid mb-3 col-sm-2"
                    />
                    <img
                        v-else-if="form.oldImage"
                        :src="`/storage/${form.oldImage}`"
                        class="img-preview img-fluid mb-3 col-sm-2"
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

                <div>
                    <label for="title" class="block font-medium"
                        >Lokasi Musyawarah</label
                    >
                    <input
                        v-model="form.location"
                        type="text"
                        id="location"
                        class="w-full border rounded p-2"
                        :class="{ 'border-red-500': form.errors.location }"
                        @change="generateSlug"
                    />
                    <p v-if="form.errors.location" class="text-red-500 text-sm">
                        {{ form.errors.location }}
                    </p>
                </div>

                <div>
                    <label class="block font-medium mb-1">Agenda</label>
                    <input
                        id="agenda"
                        type="hidden"
                        v-model="form.agenda"
                        name="agenda"
                    />
                    <trix-editor
                        input="agenda"
                        @trix-change="updateagenda"
                        ref="trixEditorRefagenda"
                    ></trix-editor>
                    <p v-if="form.errors.agenda" class="text-red-500 text-sm">
                        {{ form.errors.agenda }}
                    </p>
                </div>

                <div>
                    <label class="block font-medium mb-1"
                        >Hasil Musyawarah</label
                    >
                    <input
                        id="hasil"
                        type="hidden"
                        v-model="form.hasil"
                        name="hasil"
                    />
                    <trix-editor
                        input="hasil"
                        @trix-change="updatehasil"
                        ref="trixEditorRefhasil"
                    ></trix-editor>
                    <p v-if="form.errors.hasil" class="text-red-500 text-sm">
                        {{ form.errors.hasil }}
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
    lingkup_id: props.post?.lingkup_id || "",
    image: null,
    oldImage: props.post?.image || "",
    time: props.post?.time || "",
    location: props.post?.location || "",
    agenda: props.post?.agenda || "",
    hasil: props.post?.hasil || "",
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
    reader.onload = (e) => {
        previewUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
    console.log("File dipilih:", file);
}

console.log("KIRIM DATA:", {
    title: form.title,
    slug: form.slug,
    lingkup_id: form.lingkup_id,
    image: form.image,
    oldImage: form.oldImage,
    time: form.time,
    location: form.location,
    agenda: form.agenda,
    hasil: form.hasil,
});

function submitForm() {
    console.log("KIRIM:", {
        title: form.title,
        slug: form.slug,
        lingkup_id: form.lingkup_id,
        image: form.image,
        oldImage: form.oldImage,
        time: form.time,
        location: form.location,
        agenda: form.agenda,
        hasil: form.hasil,
    });

    form.submit("post", `/dashboard/musyawarah/${props.post.slug}`, {
        data: {
            _method: "put",
            title: form.title,
            slug: form.slug,
            lingkup_id: form.lingkup_id,
            image: form.image,
            oldImage: form.oldImage,
            time: form.time,
            location: form.location,
            agenda: form.agenda,
            hasil: form.hasil,
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
//     form.put(`/dashboard/musyawarah/${props.post.slug}`, {
//         preserveScroll: true,
//         onSuccess: () => {
//             console.log("Post updated");
//         },
//     });
// }

// form.submit("post", `/dashboard/musyawarah/${props.post.slug}`, {
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
const trixEditorRefagenda = ref(null);
const trixEditorRefhasil = ref(null);

function updateagenda(e) {
    form.agenda = e.target.innerHTML;
}
function updatehasil(e) {
    form.hasil = e.target.innerHTML;
}

// Set isi trix-editor secara manual
onMounted(() => {
    document.addEventListener("trix-file-accept", (e) => e.preventDefault());

    // Ini akan memastikan input hidden sudah terisi duluan
    // document.querySelector("#body").value = form.body;

    // Ini memastikan nilai input hidden sudah ada
    const hiddenInput = document.querySelector("#agenda");
    if (hiddenInput && form.agenda) {
        hiddenInput.value = form.agenda;

        // Tunggu nextTick agar Trix sudah siap
        setTimeout(() => {
            const editor = trixEditorRefagenda.value?.editor;
            if (editor) {
                editor.loadHTML(form.agenda); // 🌟 Ini menampilkan konten lama ke editor
            }
        }, 100);
    }
});

onMounted(() => {
    document.addEventListener("trix-file-accept", (e) => e.preventDefault());

    // Ini akan memastikan input hidden sudah terisi duluan
    // document.querySelector("#body").value = form.body;

    // Ini memastikan nilai input hidden sudah ada
    const hiddenInput = document.querySelector("#hasil");
    if (hiddenInput && form.hasil) {
        hiddenInput.value = form.hasil;

        // Tunggu nextTick agar Trix sudah siap
        setTimeout(() => {
            const editor = trixEditorRefhasil.value?.editor;
            if (editor) {
                editor.loadHTML(form.hasil); // 🌟 Ini menampilkan konten lama ke editor
            }
        }, 100);
    }
});
</script>
