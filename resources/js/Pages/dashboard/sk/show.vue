<template>
    <Layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">Cuy</div>
        </div>

        <div class="max-w-3xl mx-auto mb-5">
            <h2 class="text-2xl font-bold mb-4">{{ post.title }}</h2>

            <!-- Tombol Navigasi -->
            <div class="flex gap-2 mb-3">
                <Link href="/dashboard/sk" class="btn btn-success">
                    <i class="bi bi-arrow-left"></i> Kembali ke Semua SK Saya
                </Link>

                <a :href="`/download/${post.document}`">
                    <button class="btn btn-success" type="button">
                        Unduh File
                    </button>
                </a>

                <Link
                    :href="`/dashboard/sk/${post.slug}/edit`"
                    class="btn btn-warning"
                >
                    <i class="bi bi-pencil-square"></i> Ubah
                </Link>

                <!-- Tombol Delete -->
                <button class="btn btn-danger" @click="handleDelete(post.slug)">
                    <i class="bi bi-file-x bg-danger"></i> Hapus
                </button>
            </div>

            <!-- Info Kategori & Tanggal -->
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
                <small class="text-muted ms-2">
                    {{
                        new Date(post.created_at).toLocaleDateString("id-ID", {
                            day: "2-digit",
                            month: "long",
                            year: "numeric",
                        })
                    }}
                </small>
            </div>

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
import { usePage } from "@inertiajs/vue3";
import AdminLayout from "@/shared/Admin.vue";

const { props } = usePage();
const post = props.post;

// Props
defineProps({
    post: Array,
});

// Hapus post
function handleDelete(slug) {
    if (confirm("Are you sure?")) {
        router.delete(`/dashboard/sk/${slug}`);
    }
}

defineOptions({
    layout: AdminLayout,
});
</script>
