<template>
    <div class="relative z-50">
        <a
            class="text-blueGray-500 block"
            href="#"
            :ref="btnDropdownRef"
            @click="toggleDropdown"
        >
            <div class="link-box">
                <span
                    class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                >
                    <i class="fas fa-user"></i>
                    Halo, <strong>{{ user.name }}</strong>
                </span>
            </div>
        </a>

        <div
            :ref="popoverDropdownRef"
            class="absolute right-0 mt-2 bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
            :class="{
                hidden: !dropdownPopoverShow,
                block: dropdownPopoverShow,
            }"
        >
            <Link
                href="/logout"
                method="post"
                as="button"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
            >
                Logout
            </Link>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { createPopper } from "@popperjs/core";

// Ambil data user dari inertia
const { props } = usePage();
const user = props.auth.user;

// State untuk dropdown
const dropdownPopoverShow = ref(false);

// Refs untuk popper
const btnDropdownRef = ref(null);
const popoverDropdownRef = ref(null);

// Toggle dropdown
const toggleDropdown = (event) => {
    event.preventDefault();
    dropdownPopoverShow.value = !dropdownPopoverShow.value;

    if (dropdownPopoverShow.value) {
        createPopper(btnDropdownRef.value, popoverDropdownRef.value, {
            placement: "bottom-start",
        });
    }
};
</script>
