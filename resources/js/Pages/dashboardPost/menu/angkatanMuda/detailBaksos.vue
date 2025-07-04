<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
import Sidebar from "@/Pages/dashboardPost/menu/angkatanMuda/sidebar.vue"; // Sidebar

const props = defineProps({
    title: String,
    active: String,
    judul: String,
    baksos: Array,
});
// Format tanggal menggunakan moment.js
// const formattedDate = moment(props.musyawarah.time).format(
//     "DD MMMM YYYY, HH:mm"
// );

// Debugging
console.log("baksos:", props.baksos);
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
                <h1>Baksos Angkatan Muda</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Baksos Angkatan Muda</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Baksos Angkatan Muda</li>
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
                        <!--Law Section-->
                        <section class="law-section">
                            <div
                                class=""
                                style="font-size: 15px; line-height: 1.7"
                            >
                                <h3>Bakti Sosial Idul Adha</h3>
                                <br />
                                <h3>{{ baksos.title }}</h3>

                                <!-- {{-- pengecekan gambar kosong atau ada --}} -->

                                <div
                                    v-if="baksos.image"
                                    style="max-height: 400px; overflow: hidden"
                                >
                                    <img
                                        :src="`/storage/${baksos.image}`"
                                        width="370"
                                        height="250"
                                        class="card-img-top"
                                        alt="{{ baksos.title }}"
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
                                <div class="text" v-html="baksos.body"></div>
                            </div>
                        </section>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
