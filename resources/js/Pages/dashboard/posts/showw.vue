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

            <!-- Tombol Aksi -->
            <div class="flex gap-2 mb-4">
                <!-- Kembali -->
                <Link
                    href="/dashboard/posts"
                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke semua Postingan Saya
                </Link>

                <!-- Edit -->
                <Link
                    :href="`/dashboard/posts/${post.slug}/edit`"
                    class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium transition"
                >
                    <i class="bi bi-pencil-square"></i>
                    Ubah
                </Link>

                <!-- Hapus -->
                <button
                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition"
                    @click="handleDelete(post.slug)"
                >
                    <i class="bi bi-file-x"></i>
                    Hapus
                </button>
            </div>

            <!-- Gambar -->
            <div
                v-if="post.image"
                class="max-h-[400px] max-w-[750px] overflow-hidden"
            >
                <img
                    :src="`/storage/post-images/original/${post.image}`"
                    class="mt-3 rounded-lg shadow"
                    :alt="post.category?.name"
                />
            </div>
            <div v-else>
                <img
                    src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                    width="750"
                    height="400"
                    class="mt-3 rounded-lg shadow"
                    :alt="post.category?.name"
                />
            </div>

            <!-- Konten -->
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
