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
    inventaris: Object,
});

// Debugging
console.log("Inventaris:", props.inventaris);
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
                        <li>Inventaris Aisyiyah</li>
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
                            <div class="">
                                <h3>Inventaris Muhammadiyah</h3>
                                <br />
                                <h3>Nama Barang: {{ inventaris.title }}</h3>
                                <h5>Qty: {{ inventaris.quantity }}</h5>
                                <h5>
                                    Lokasi Barang: {{ inventaris.location }}
                                </h5>

                                <!-- {{-- pengecekan gambar kosong atau ada --}} -->

                                <div
                                    v-if="inventaris.image"
                                    style="max-height: 400px; overflow: hidden"
                                >
                                    <img
                                        :src="`/storage/${inventaris.image}`"
                                        width="370"
                                        height="250"
                                        class="card-img-top"
                                        alt="{{ inventaris.title }}"
                                    />
                                </div>

                                <img
                                    v-else
                                    src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                    width="370"
                                    height="250"
                                    class="card-img-top"
                                    alt=""
                                />

                                <br />
                                <div
                                    class="text"
                                    v-html="inventaris.description"
                                ></div>
                            </div>
                        </section>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
