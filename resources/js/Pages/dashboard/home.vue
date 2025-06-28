<script setup>
import { defineProps } from "vue";
import { onMounted, ref } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
// import AppLayout from "@/shared/adminLayout.vue";

defineProps({
    totalUsers: Number,
    totalPosts: Number,
    totalKajians: Number,
});

// const { totalUsers, totalPosts, totalKajians } = usePage().props;
</script>

<template>
    <AppLayout>
        <div>
            <h1>Selamat Datang di Inertia.js</h1>
            <p>Mode Debug Aktif</p>
        </div>
    </AppLayout>
</template>
