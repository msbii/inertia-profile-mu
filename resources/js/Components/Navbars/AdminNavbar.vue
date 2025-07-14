<template>
    <!-- <nav
        class="fixed top-0 left-16 w-full md:w-[calc(100%-16rem)] z-50 bg-emerald-600 shadow-md px-4 py-3 flex items-center justify-between"
    > -->
    <nav
        class="fixed top-0 w-full z-50 bg-emerald-600 shadow-md px-4 py-3 flex items-center justify-between"
    >
        <!-- Brand -->
        <div class="w-full md:w-8/12 px-4">
            <a
                class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                href="/"
            >
                <i class="fas fa-home"></i>
                Beranda
            </a>
        </div>

        <!-- User Dropdown -->
        <div class="w-full md:w-4/12 px-4 relative" ref="dropdownWrapper">
            <button
                @click="toggleDropdown"
                class="text-white font-semibold flex items-center gap-2"
            >
                <i class="fas fa-user"></i>
                Halo, {{ user?.name }}
            </button>
            <div
                v-if="showDropdown"
                class="absolute mt-2 bg-white shadow-lg rounded z-[999]"
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
