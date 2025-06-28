<template>
    <Layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">Cuy</div>
        </div>

        <div class="max-w-3xl mx-auto mb-5">
            <h2>{{ post.title }}</h2>

            <Link href="/dashboard/struktur" class="btn btn-success">
                <i class="bi bi-arrow-left"></i> Kembali ke Semua SK Saya
            </Link>

            <a :href="`/download-image/${post.image}`">
                <button class="btn btn-success" type="button">
                    Unduh Gambar
                </button>
            </a>

            <Link
                :href="`/dashboard/struktur/${post.slug}/edit`"
                class="btn btn-warning"
            >
                <i class="bi bi-pencil-square"></i> Ubah
            </Link>

            <!-- Delete Form -->
            <form
                :action="`/dashboard/struktur/${post.slug}`"
                method="post"
                class="d-inline"
                @submit.prevent="deletePost"
            >
                <button class="btn btn-danger" @click="handleDelete(post.slug)">
                    <i class="bi bi-file-x bg-danger"></i> Hapus
                </button>
            </form>

            <div class="d-flex justify-content-center align-items-center">
                <p>
                    di
                    <Link
                        :href="`/kategori/${post.kategori.slug}`"
                        class="text-decoration-none"
                    >
                        {{ post.kategori.name }}
                    </Link>
                </p>
                <small class="text-muted">{{
                    formatDate(post.created_at)
                }}</small>
            </div>

            <!-- Gambar -->
            <div v-if="post.image" style="max-height: 400px; overflow: hidden">
                <img
                    :src="`/storage/${post.image}`"
                    class="card-img-top mt-3"
                    :alt="post.title"
                />
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { router, Link } from "@inertiajs/vue3";
import AdminLayout from "@/shared/Admin.vue";

// Props
defineProps({
    post: Object,
});

// Hapus post
function handleDelete(slug) {
    if (confirm("Are you sure?")) {
        router.delete(`/dashboard/struktur/${slug}`);
    }
}

defineOptions({
    layout: AdminLayout,
});

function formatDate(date) {
    return new Date(date).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
    });
}
</script>
