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
                                <Link href="/dashboard/sejarah/create">
                                    <button
                                        type="button"
                                        class="btn btn-success my-2"
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
                                        class="form-input"
                                    />
                                    <button type="submit" class="btn">
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
                                <tr>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                        :class="[
                                            color === 'light'
                                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                        ]"
                                    >
                                        #
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                        :class="[
                                            color === 'light'
                                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                        ]"
                                    >
                                        Gambar
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                        :class="[
                                            color === 'light'
                                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                        ]"
                                    >
                                        Judul
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                        :class="[
                                            color === 'light'
                                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                        ]"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="sejarah?.data.length">
                                <tr
                                    v-for="(post, index) in sejarah.data"
                                    :key="post.id"
                                >
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center"
                                    >
                                        <!-- <img
                                            :src="bootstrap"
                                            class="h-12 w-12 bg-white rounded-full border"
                                            alt="..."
                                        /> -->
                                        <span
                                            class="ml-3 font-bold"
                                            :class="[
                                                color === 'light'
                                                    ? 'text-blueGray-600'
                                                    : 'text-white',
                                            ]"
                                        >
                                            {{
                                                (sejarah.current_page - 1) *
                                                    sejarah.per_page +
                                                index +
                                                1
                                            }}
                                        </span>
                                    </th>
                                    <td class="cart__table--body__list">
                                        <div
                                            class="cart__product d-flex align-items-center"
                                        >
                                            <div class="cart__thumbnail">
                                                <a href="product-details.html">
                                                    <img
                                                        class="border-radius-5"
                                                        :src="`/storage/${post.image}`"
                                                        alt="cart-product"
                                                        style="
                                                            max-width: 70px;
                                                            max-height: 60px;
                                                        "
                                                    />
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                                    >
                                        {{ post.title }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                                    >
                                        <!-- Tombol Lihat -->
                                        <Link
                                            :href="`/dashboard/sejarah/${post.slug}`"
                                        >
                                            <button
                                                class="btn btn-success mx-1 btn-view"
                                            >
                                                <i
                                                    class="bi bi-file-earmark-text bg-info"
                                                ></i>
                                                Lihat
                                            </button>
                                        </Link>
                                        <!-- Tombol Ubah -->
                                        <Link
                                            :href="`/dashboard/sejarah/${post.slug}/edit`"
                                        >
                                            <button
                                                class="btn btn-warning mx-1 btn-edit"
                                            >
                                                <i class="fas fa-edit"></i> Ubah
                                            </button>
                                        </Link>

                                        <!-- Tombol Hapus -->
                                        <!-- <button
                                            class="btn btn-danger mx-1"
                                            @click="handleDelete(post.slug)"
                                        >
                                            <i
                                                class="fas fa-trash bg-danger"
                                            ></i>
                                            Hapus
                                        </button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :links="sejarah.links" />
                    </div>
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
    sejarah: Object,
    filters: Object,
});

function handleDelete(slug) {
    if (confirm("Are you sure?")) {
        router.delete(`/dashboard/sejarah/${slug}`);
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
        "/dashboard/sejarah", // Ganti sesuai route kamu
        { search: search.value },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

watch(search, (newValue) => {
    router.get(
        "/dashboard/sejarah",
        { search: newValue },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>
