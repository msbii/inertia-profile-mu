<script>
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
// import MainLayout from "../shared/mainLayout.vue";

export default {
    components: {
        Link,
        Layout,
    },
    props: ["debug"],
    props: {
        sejarah: Array, // Data sejarah dari Laravel
    },
};
</script>

<style></style>

<template>
    <Layout>
        <div>
            <h1>Selamat Datang di Inertia.js</h1>
            <p v-if="debug">Mode Debug Aktif</p>

            <div class="styled-heading">
                <h2>Kategori Postingan</h2>
            </div>
            <ul>
                <li v-for="post in sejarah" :key="post.slug">
                    <Link :href="'/' + post.slug">{{ post.title }}</Link>
                </li>
            </ul>
        </div>
    </Layout>
</template>
