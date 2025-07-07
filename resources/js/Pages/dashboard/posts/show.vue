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

            <div class="flex gap-2 mb-4">
                <Link href="/dashboard/posts" class="btn btn-success">
                    <i class="bi bi-arrow-left"></i> Kembali ke semua Postingan
                    Saya
                </Link>
                <Link
                    :href="`/dashboard/posts/${post.slug}/edit`"
                    class="btn btn-warning"
                >
                    <i class="bi bi-pencil-square"></i> Ubah
                </Link>

                <button class="btn btn-danger" @click="handleDelete(post.slug)">
                    <i class="bi bi-file-x bg-danger"></i> Hapus
                </button>
            </div>

            <div v-if="post.image" class="overflow-hidden max-h-[400px]">
                <img
                    :src="`/storage/${post.image}`"
                    class="card-img-top mt-3"
                    :alt="post.category?.name"
                />
            </div>
            <div v-else>
                <img
                    src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                    width="750"
                    height="400"
                    class="card-img-top mt-3"
                    :alt="post.category?.name"
                />
            </div>

            <article class="my-3 prose max-w-full" v-html="post.body"></article>
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
        router.delete(`/dashboard/posts/${slug}`);
    }
}

defineOptions({
    layout: AdminLayout,
});
</script>
