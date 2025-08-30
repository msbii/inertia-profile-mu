<template>
    <Layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4"></div>
        </div>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4"></div>
        </div>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <!-- <card-table /> -->
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
                    :class="[
                        color === 'light'
                            ? 'bg-white'
                            : 'bg-emerald-900 text-white',
                    ]"
                >
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div
                                class="relative w-full px-4 max-w-full flex-grow flex-1"
                            >
                                <!-- <h3
                                    class="font-semibold text-lg"
                                    :class="[
                                        color === 'light'
                                            ? 'text-blueGray-700'
                                            : 'text-white',
                                    ]"
                                >
                                    Card Tables
                                </h3> -->
                                <Link href="/dashboard/posts/create">
                                    <button
                                        type="button"
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded my-2 flex items-center gap-2"
                                    >
                                        <i class="fas fa-plus"></i> Buat
                                        Postingan Baru
                                    </button>
                                </Link>

                                <form @submit.prevent="submit">
                                    <input
                                        v-model="search"
                                        type="text"
                                        placeholder="Cari postingan..."
                                        class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                    <button
                                        type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
                                    >
                                        Cari
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p v-if="$page.props.flash?.success" class="text-green-500">
                        {{ $page.props.flash.success }}
                    </p>
                    <div class="block w-full overflow-x-auto">
                        <!-- Projects table -->
                        <table
                            class="items-center w-full bg-transparent border-collapse"
                        >
                            <thead>
                                <tr class="bg-gray-100 text-gray-600">
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase border text-left align-middle whitespace-nowrap"
                                    >
                                        #
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase border text-left max-w-[100px] truncate"
                                    >
                                        Judul
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase border text-left align-middle whitespace-nowrap"
                                    >
                                        Kategori
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase border text-left align-middle whitespace-nowrap"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="posts?.data?.length">
                                <tr
                                    v-for="(post, index) in posts.data"
                                    :key="post.id"
                                    class="border-b"
                                >
                                    <!-- Nomor urut -->
                                    <th
                                        class="px-6 py-4 text-xs text-left align-middle whitespace-nowrap"
                                    >
                                        <span class="font-bold text-gray-700">
                                            {{
                                                (posts.current_page - 1) *
                                                    posts.per_page +
                                                index +
                                                1
                                            }}
                                        </span>
                                    </th>

                                    <!-- Judul -->
                                    <td
                                        class="px-6 py-4 text-xs align-middle whitespace-nowrap truncate max-w-[200px]"
                                    >
                                        {{ post.title }}
                                    </td>

                                    <!-- Kategori -->
                                    <td
                                        v-if="post.category"
                                        class="px-6 py-4 text-xs align-middle whitespace-nowrap"
                                    >
                                        {{ post.category.name }}
                                    </td>

                                    <!-- Aksi -->
                                    <td
                                        class="px-6 py-4 text-xs align-middle whitespace-nowrap flex items-center gap-2"
                                    >
                                        <!-- Tombol Lihat -->
                                        <Link
                                            :href="`/dashboard/posts/${post.slug}`"
                                        >
                                            <button
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded flex items-center gap-2 text-sm"
                                            >
                                                <i
                                                    class="bi bi-file-earmark-text"
                                                ></i>
                                                Lihat
                                            </button>
                                        </Link>

                                        <!-- Tombol Ubah -->
                                        <Link
                                            :href="`/dashboard/posts/${post.slug}/edit`"
                                        >
                                            <button
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded flex items-center gap-2 text-sm"
                                            >
                                                <i class="fas fa-edit"></i>
                                                Ubah
                                            </button>
                                        </Link>

                                        <!-- Tombol Hapus -->
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded flex items-center gap-2 text-sm"
                                            @click="handleDelete(post.slug)"
                                        >
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :links="posts.links" />
                    </div>
                    <!-- <div class="p-4">
                        <div class="flex justify-center space-x-2">
                            <Link
                                v-for="link in posts.links"
                                :key="link.label"
                                :href="link.url"
                                v-html="link.label"
                                class="px-3 py-1 rounded text-sm"
                                :class="{
                                    'bg-blue-500 text-white': link.active,
                                    'bg-gray-200 text-gray-700': !link.active,
                                    'cursor-not-allowed pointer-events-none':
                                        !link.url,
                                }"
                            />
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </Layout>
</template>
<script setup>
import CardTable from "@/Components/Cards/CardTable.vue";
import AdminLayout from "@/shared/Admin.vue";
import Pagination from "@/Components/Pagination.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

import { defineProps } from "vue";
import TableDropdown from "@/Components/Dropdowns/TableDropdown.vue";

import bootstrap from "@/assets/img/bootstrap.jpg";
import angular from "@/assets/img/angular.jpg";
import sketch from "@/assets/img/sketch.jpg";
import react from "@/assets/img/react.jpg";
import vue from "@/assets/img/vue.jpg";

import team1 from "@/assets/img/team-1-800x800.jpg";
import team2 from "@/assets/img/team-2-800x800.jpg";
import team3 from "@/assets/img/team-3-800x800.jpg";
import team4 from "@/assets/img/team-4-470x470.png";

import { usePage } from "@inertiajs/vue3";

const { props } = usePage();

console.log(props.flash.success); // "Posting telah diperbarui!"

// Props
defineProps({
    color: {
        default: "light",
        validator: (value) => ["light", "dark"].includes(value),
    },
    posts: Object,
    filters: Object,
});

function handleDelete(slug) {
    if (confirm("Are you sure?")) {
        router.delete(`/dashboard/posts/${slug}`);
    }
}

defineOptions({
    // Inertia layout injection
    layout: AdminLayout,
});

// Images to use in template
const images = {
    bootstrap,
    angular,
    sketch,
    react,
    vue,
    team1,
    team2,
    team3,
    team4,
};

// Reactive search input (isi awal dari query string, jika ada)
const search = ref(props.filters.search || "");

// Kirim query pencarian ke server
const submit = () => {
    router.get(
        "/dashboard/posts", // Ganti sesuai route kamu
        { search: search.value },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

watch(search, (newValue) => {
    router.get(
        "/dashboard/posts",
        { search: newValue },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>
