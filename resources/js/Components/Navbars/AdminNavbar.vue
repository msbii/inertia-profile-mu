<template>
    <!-- <nav
        class="fixed top-0 left-16 w-full md:w-[calc(100%-16rem)] z-50 bg-emerald-600 shadow-md px-4 py-3 flex items-center justify-between"
    > -->
    <!-- <nav
        class="fixed top-0 w-full z-50 bg-emerald-600 shadow-md px-4 py-3 flex items-center justify-between"
    > -->
    <nav
        class="fixed top-0 w-full z-[9999] bg-emerald-600 shadow-md px-4 py-3 flex items-center justify-between"
    >
        <!-- Brand -->
        <div class="text-white font-bold text-lg">
            <i class="fas fa-home mr-2"></i> Beranda
        </div>

        <!-- User Dropdown -->
        <div class="relative" ref="dropdownWrapper">
            <button
                @click="toggleDropdown"
                class="text-white font-semibold flex items-center gap-2"
            >
                <i class="fas fa-user"></i>
                Halo, {{ user?.name }}
            </button>
            <div
                v-if="showDropdown"
                class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded z-[9999]"
            >
                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 w-full text-left"
                >
                    Logout
                </Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, onClickOutside } from "vue";
import { usePage, Link } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
const showDropdown = ref(false);

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};
</script>
