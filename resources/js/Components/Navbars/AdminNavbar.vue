<template>
    <!-- Navbar -->
    <nav
        class="fixed top-0 left-0 w-full z-30 bg-emerald-600 md:ml-64 flex items-center p-4"
    >
        <div
            class="w-full mx-auto flex justify-between items-center md:px-10 px-4"
        >
            <!-- Brand -->
            <a
                class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                href="/"
            >
                <i class="fas fa-home"></i> Beranda
            </a>

            <!-- User Dropdown -->
            <ul
                class="relative flex-col md:flex-row list-none items-center hidden md:flex"
            >
                <user-dropdown />
            </ul>
        </div>
    </nav>
</template>

<script setup>
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";
</script>
