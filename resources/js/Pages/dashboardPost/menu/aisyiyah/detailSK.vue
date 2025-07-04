<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
import Sidebar from "@/Pages/dashboardPost/menu/aisyiyah/sidebar.vue"; // Sidebar

const props = defineProps({
    title: String,
    active: String,
    kategoriKajian: Array,
    kategoriSK: Array,
    sejarah: Array,
    pelaksana: Array,
    post: Object,
    listSK: Array,
});

// Debugging
console.log("struktur:", props.post);
console.log("SK:", props.listSK);
</script>
<template>
    <Layout>
        <!-- Page Title -->
        <section
            class="page-title"
            style="background-image: url('/img/Logo3.jpg')"
        >
            <div class="auto-container">
                <h1>Lingkup Aisyiyah</h1>
            </div>
        </section>

        <!-- Page Info -->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left">
                    <h2>Lingkup Aisyiyah</h2>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Lingkup Aisyiyah</li>
                    </ul>
                </div>
            </div>
        </section>

        <!--Sidebar Page-->
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Sidebar-->
                    <Sidebar
                        :sejarah="sejarah"
                        :kategoriSK="kategoriSK"
                        :kategoriKajian="kategoriKajian"
                        :pelaksana="pelaksana"
                    />

                    <!--Content Side-->
                    <div
                        class="col-lg-9 col-md-8 col-sm-12 col-xs-12 pull-right"
                    >
                        <!--Law Section-->
                        <section class="law-section">
                            <div
                                class=""
                                style="font-size: 15px; line-height: 1.7"
                            >
                                <div class="tags">
                                    <span class="icon fa fa-tags"></span>&ensp;
                                    <Link
                                        :href="`/sk/aisyiyah/${post.kategori.slug}`"
                                        >{{ post.kategori.name }}</Link
                                    >
                                </div>
                                <h3>{{ post.title }}</h3>
                                <div class="text" v-html="post.body"></div>
                                <iframe
                                    :src="`/storage/post-document/${post.document}`"
                                    width="100%"
                                    height="600px"
                                    style="border: none"
                                >
                                </iframe>
                                <Link :href="`/download/${post.document}`">
                                    <button
                                        class="btn btn-success"
                                        type="button"
                                    >
                                        Download file
                                    </button>
                                </Link>
                                <br />
                            </div>

                            <!--Upper Part-->
                        </section>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
