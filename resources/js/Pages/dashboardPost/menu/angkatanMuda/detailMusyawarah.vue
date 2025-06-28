<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
import Sidebar from "@/Pages/dashboardPost/menu/angkatanMuda/sidebar.vue"; // Sidebar

const props = defineProps({
    title: String,
    active: String,
    musyawarah: Array,
});
// Format tanggal menggunakan moment.js
// const formattedDate = moment(props.musyawarah.time).format(
//     "DD MMMM YYYY, HH:mm"
// );

// Debugging
console.log("musyawarah:", props.musyawarah);
</script>

<template>
    <Layout>
        <!--Page Title-->
        <section
            class="page-title"
            style="background-image: url('/img/Logo3.jpg')"
        >
            <!-- <img :src="'/img/Logo3.jpg'" alt="" /> -->
            <div class="auto-container">
                <h1>Musyawarah Angkatan Muda</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Musyawarah Angkatan Muda</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Musyawarah Angkatan Muda</li>
                    </ul>
                </div>
            </div>
        </section>

        <!--Sidebar Page-->
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Sidebar-->
                    <Sidebar />

                    <!--Content Side-->
                    <div
                        class="col-lg-9 col-md-8 col-sm-12 col-xs-12 pull-right"
                    >
                        <section class="law-section">
                            <div class="">
                                <h3>Detail Musyawarah</h3>
                                <br />
                                <h3>Musyawarah: {{ musyawarah.title }}</h3>
                                <h5>
                                    Tanggal: {{ musyawarah.time_formatted }}
                                </h5>
                                <h5>
                                    Lokasi Barang: {{ musyawarah.location }}
                                </h5>

                                <!-- Pengecekan gambar kosong atau ada -->
                                <div
                                    v-if="musyawarah.image"
                                    style="max-height: 400px; overflow: hidden"
                                >
                                    <img
                                        :src="`/storage/${musyawarah.image}`"
                                        width="370"
                                        height="250"
                                        class="card-img-top"
                                        :alt="musyawarah.title"
                                    />
                                </div>
                                <img
                                    v-else
                                    src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                    width="370"
                                    height="250"
                                    class="card-img-top"
                                    alt="Default Image"
                                />

                                <br />
                                <div class="text">
                                    Agenda:
                                    <div v-html="musyawarah.agenda"></div>
                                </div>
                                <div class="text">
                                    Hasil Musyawarah:
                                    <div v-html="musyawarah.hasil"></div>
                                </div>
                            </div>
                            <!-- <p class="text-center fs-4">No Post Found</p> -->
                        </section>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
