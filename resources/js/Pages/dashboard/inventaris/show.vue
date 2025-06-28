<template>
    <Layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">Cuy</div>
        </div>

        <div class="max-w-3xl mx-auto mb-5">
            <h2 class="text-2xl font-bold mb-4">{{ post.title }}</h2>

            <div class="flex gap-2 mb-4">
                <Link href="/dashboard/inventaris" class="btn btn-success">
                    <i class="bi bi-arrow-left"></i> Kembali ke semua Postingan
                    Saya
                </Link>
                <Link
                    :href="`/dashboard/inventaris/${post.slug}/edit`"
                    class="btn btn-warning"
                >
                    <i class="bi bi-pencil-square"></i> Ubah
                </Link>

                <button class="btn btn-danger" @click="handleDelete(post.slug)">
                    <i class="bi bi-file-x bg-danger"></i> Hapus
                </button>
            </div>

            <h2>Nama Barang : {{ post.title }}</h2>
            <h5>Jumlah Barang: {{ post.quantity }}</h5>
            <h5>Lokasi Barang : {{ post.location }}</h5>
            <h5>Lingkup : {{ post.lingkup.name }}</h5>

            <!-- Cek jika post memiliki gambar -->
            <div v-if="post.image" style="max-height: 400px; overflow: hidden">
                <img
                    :src="`/storage/${post.image}`"
                    class="card-img-top mt-3"
                    :alt="post.title"
                />
            </div>
            <div v-else>
                <img
                    :src="`https://source.unsplash.com/1200x400?${post.title}`"
                    class="card-img-top mt-3"
                    :alt="post.title"
                />
            </div>

            <!-- Deskripsi HTML -->
            <article class="my-3" v-html="post.description"></article>
        </div>
    </Layout>
</template>

<script setup>
import { router, Link } from "@inertiajs/vue3";
import AdminLayout from "@/shared/Admin.vue";
import { usePage } from "@inertiajs/vue3";

const { props } = usePage();

// Debugging
console.log("kajian:", props.post);

// Props
defineProps({
    post: Array,
});

// Hapus post
function handleDelete(slug) {
    if (confirm("Are you sure?")) {
        router.delete(`/dashboard/inventaris/${slug}`);
    }
}

defineOptions({
    layout: AdminLayout,
});
</script>
