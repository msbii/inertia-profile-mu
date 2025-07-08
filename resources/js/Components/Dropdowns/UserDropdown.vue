<template>
    <div>
        <!-- Trigger -->
        <a
            class="text-white text-sm uppercase font-semibold cursor-pointer"
            href="#"
            :ref="btnDropdownRef"
            @click="toggleDropdown"
        >
            <i class="fas fa-user"></i> Halo, <strong>{{ user.name }}</strong>
        </a>

        <!-- Dropdown -->
        <div
            :ref="popoverDropdownRef"
            class="absolute right-0 mt-2 bg-white text-base z-50 py-2 list-none text-left rounded shadow-lg min-w-48"
            :class="dropdownPopoverShow ? 'block' : 'hidden'"
        >
            <Link
                href="/logout"
                method="post"
                as="button"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 hover:bg-gray-100"
            >
                Logout
            </Link>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { createPopper } from "@popperjs/core";

const { props } = usePage();
const user = props.auth.user;

const dropdownPopoverShow = ref(false);
const btnDropdownRef = ref(null);
const popoverDropdownRef = ref(null);

const toggleDropdown = (e) => {
    e.preventDefault();
    dropdownPopoverShow.value = !dropdownPopoverShow.value;

    if (dropdownPopoverShow.value) {
        createPopper(btnDropdownRef.value, popoverDropdownRef.value, {
            placement: "bottom-start",
        });
    }
};
</script>
