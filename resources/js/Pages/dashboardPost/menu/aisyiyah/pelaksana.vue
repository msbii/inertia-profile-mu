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
    pelaksanaProgram: Object,
});

// Debugging
console.log("struktur:", props.pelaksana);
console.log("pelaksana:", props.pelaksanaProgram);
</script>
<template>
    <Layout>
        <!-- Page Title -->
        <section
            class="page-title"
            style="background-image: url('/img/Logo3.jpg')"
        >
            <div class="auto-container">
                <h1>Pelaksana Program Aisyiyah</h1>
            </div>
        </section>

        <!-- Page Info -->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left">
                    <h2>Pelaksana Program Aisyiyah</h2>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Pelaksana Program Aisyiyah</li>
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
                                <h3>Pelaksanaan Program</h3>
                                <br />
                                <h3>{{ pelaksanaProgram.title }}</h3>
                                <h5>
                                    Nama Pelaksana: {{ pelaksanaProgram.name }}
                                </h5>

                                <!-- {{-- pengecekan gambar kosong atau ada --}} -->

                                <div
                                    v-if="pelaksanaProgram.image"
                                    style="max-height: 400px; overflow: hidden"
                                >
                                    <img
                                        :src="`/storage/${pelaksanaProgram.image}`"
                                        width="370"
                                        height="250"
                                        class="card-img-top"
                                        alt="{{ pelaksanaProgram.title }}"
                                    />
                                </div>

                                <div v-else>
                                    <img
                                        src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                        width="370"
                                        height="250"
                                        class="card-img-top"
                                        alt=""
                                    />
                                </div>

                                <br />
                                <div class="text">
                                    Deskripsi:
                                    <div
                                        v-html="pelaksanaProgram.description"
                                    ></div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
