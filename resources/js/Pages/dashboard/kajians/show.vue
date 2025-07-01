<template>
    <Layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">Cuy</div>
        </div>

        <div class="max-w-3xl mx-auto mb-5">
            <h2>{{ post.title }}</h2>

            <div class="mb-3">
                <Link href="/dashboard/kajian" class="btn btn-success">
                    <i class="bi bi-arrow-left"></i> Kembali ke Semua Kajian
                    Saya
                </Link>

                <a :href="`/download/${post.document}`">
                    <button class="btn btn-success">Unduh File</button>
                </a>

                <Link
                    :href="`/dashboard/kajian/${post.slug}/edit`"
                    class="btn btn-warning"
                >
                    <i class="bi bi-pencil-square"></i> Ubah
                </Link>

                <form
                    :action="`/dashboard/kajian/${post.slug}`"
                    method="POST"
                    class="d-inline"
                    @submit.prevent="deletePost"
                >
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="_token" :value="csrf" />
                    <button
                        class="btn btn-danger"
                        type="submit"
                        @click="confirmDelete"
                    >
                        <i class="bi bi-file-x bg-danger"></i> Hapus
                    </button>
                </form>
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <p>
                    <span v-if="post.speaker">
                        Pembicara
                        <Link
                            :href="`/speaker/kajian/${post.speaker}`"
                            class="text-decoration-none"
                            >{{ post.speaker }}</Link
                        >
                    </span>
                    <span v-else>
                        By.
                        <Link
                            :href="`/authors/kajian/${post.author.username}`"
                            class="text-decoration-none"
                            >{{ post.author.username }}</Link
                        >
                    </span>
                    di
                    <Link
                        :href="`/kategori/${post.kategori_kajian.slug}`"
                        class="text-decoration-none"
                        >{{ post.kategori_kajian.name }}</Link
                    >
                </p>
                <small class="text-muted">{{
                    formatDate(post.created_at)
                }}</small>
            </div>

            <div v-if="post.image" style="max-height: 400px; overflow: hidden">
                <img
                    :src="`/storage/${post.image}`"
                    class="card-img-top mt-3"
                    :alt="post.kategori_kajian.name"
                />
            </div>
            <div v-else>
                <img
                    :src="`https://source.unsplash.com/1200x400?${post.kategori_kajian.name}`"
                    class="card-img-top mt-3"
                    :alt="post.kategori_kajian.name"
                />
            </div>

            <article class="my-3" v-html="post.body" />

            <!-- Preview Dokumen -->
            <template v-if="post.document">
                <iframe
                    :src="`/storage/post-document/${post.document}`"
                    width="100%"
                    height="600px"
                    style="border: none"
                ></iframe>
            </template>
            <template v-else>
                <p class="text-red-500">Dokumen tidak tersedia.</p>
            </template>
        </div>
    </Layout>
</template>

<script setup>
import { router, Link } from "@inertiajs/vue3";
import AdminLayout from "@/shared/Admin.vue";
import { usePage } from "@inertiajs/vue3";
import { inject } from "vue";

const { props } = usePage();

// Debugging
console.log("kajian:", props.post);

// Props
defineProps({
    post: Object,
});

const csrf =
    inject("csrf") ||
    document.querySelector('meta[name="csrf-token"]').getAttribute("content");

// Hapus post
function handleDelete(slug) {
    if (confirm("Are you sure?")) {
        router.delete(`/dashboard/kajian/${slug}`);
    }
}

defineOptions({
    layout: AdminLayout,
});

function formatDate(date) {
    const d = new Date(date);
    return d.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
    });
}
</script>
