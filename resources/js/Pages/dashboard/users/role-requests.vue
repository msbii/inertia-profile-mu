<template>
    <Layout>
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
                                <form @submit.prevent="submitSearch">
                                    <input
                                        v-model="search"
                                        type="text"
                                        placeholder="Cari requestingan..."
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
                                        Nama
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                        :class="[
                                            color === 'light'
                                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                        ]"
                                    >
                                        Requested Role
                                    </th>
                                    <th
                                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                        :class="[
                                            color === 'light'
                                                ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                        ]"
                                    >
                                        Status
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
                            <!-- <tbody v-if="user?.data.length"> -->
                            <tbody v-if="requests?.data.length">
                                <tr
                                    v-for="(request, index) in requests.data"
                                    :key="request.id"
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
                                                (requests.current_page - 1) *
                                                    requests.per_page +
                                                index +
                                                1
                                            }}
                                        </span>
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                                    >
                                        {{ request.user.name }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                                    >
                                        {{ request.requested_role }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                                    >
                                        {{ request.status }}
                                    </td>

                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                                    >
                                        <button
                                            class="btn btn-success"
                                            @click="
                                                submit(request.id, 'approved')
                                            "
                                        >
                                            Approve
                                        </button>
                                        <button
                                            class="btn btn-danger"
                                            @click="
                                                submit(request.id, 'rejected')
                                            "
                                        >
                                            Reject
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script setup>
import CardTable from "@/Components/Cards/CardTable.vue";
import AdminLayout from "@/shared/Admin.vue";
import { Link, router, usePage, useForm } from "@inertiajs/vue3";
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

const { props } = usePage();

console.log(props.flash.success); // "requesting telah diperbarui!"
// Debugging
console.log("data request:", props.requests);

// Props
defineProps({
    color: {
        default: "light",
        validator: (value) => ["light", "dark"].includes(value),
    },
    requests: Object,
    filters: Object,
});

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

const form = useForm({
    status: "",
});

// Reactive search input (isi awal dari query string, jika ada)
const search = ref(props.filters.search || "");

// Kirim query pencarian ke server
const submitSearch = () => {
    router.get(
        "/admin/role-requests", // Ganti sesuai route kamu
        { search: search.value },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

function submit(id, status) {
    router.patch(`/admin/role-requests/${id}`, { status });
}

watch(search, (newValue) => {
    router.get(
        "/admin/role-requests",
        { search: newValue },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>
