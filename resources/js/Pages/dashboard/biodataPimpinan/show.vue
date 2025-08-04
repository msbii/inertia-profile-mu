<template>
    <Layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4"></div>
        </div>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4"></div>
        </div>

        <div class="max-w-3xl mx-auto mb-5">
            <h2 class="text-2xl font-bold mb-4">{{ post.title }}</h2>
            <h5>{{ post.position.name }}</h5>

            <Link href="/dashboard/biodataPimpinan" class="btn btn-success">
                <i class="bi bi-arrow-left"></i> Kembali ke semua Postingan Saya
            </Link>

            <Link
                :href="`/dashboard/biodataPimpinan/${post.slug}/edit`"
                class="btn btn-warning"
            >
                <i class="bi bi-pencil-square"></i> Ubah
            </Link>

            <!-- Delete Form -->
            <form
                :action="`/dashboard/biodataPimpinan/${post.slug}`"
                method="post"
                class="d-inline"
                @submit.prevent="deletePost"
            >
                <button class="btn btn-danger" @click="handleDelete(post.slug)">
                    <i class="bi bi-file-x bg-danger"></i> Hapus
                </button>
            </form>

            <!-- Gambar -->
            <div
                v-if="post.image"
                style="max-height: 400px; max-width: 750px; overflow: hidden"
            >
                <img
                    :src="`/storage/${post.image}`"
                    class="card-img-top mt-3"
                    :alt="post.position.name"
                />
            </div>
            <div v-else>
                <img
                    :src="`https://source.unsplash.com/1200x400?${post.position.name}`"
                    class="card-img-top mt-3"
                    :alt="post.position.name"
                />
            </div>

            <!-- Biografi -->
            <article class="my-3" v-html="post.biography"></article>
        </div>
    </Layout>
</template>

<script setup>
import { router, Link } from "@inertiajs/vue3";
import AdminLayout from "@/shared/Admin.vue";

// Props
defineProps({
    post: Array,
});

// Hapus post
function handleDelete(slug) {
    if (confirm("Are you sure?")) {
        router.delete(`/dashboard/biodataPimpinan/${slug}`);
    }
}

defineOptions({
    layout: AdminLayout,
});
</script>
