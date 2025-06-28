<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
import Sidebar from "@/Pages/dashboardPost/amal/masjidAlKhasanah/sidebar.vue"; // Sidebar

const props = defineProps({
    title: String,
    active: String,
    kategoriKajian: Array,
    post: Array,
});

// Debugging
console.log("Sejarah:", props.post);
// console.log("posts By:", props.posts);
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
                <h1>Sejarah Masjid Al Khasanah</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Sejarah Masjid Al Khasanah</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Sejarah Masjid Al Khasanah</li>
                    </ul>
                </div>
            </div>
        </section>

        <!--Sidebar Page-->
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Sidebar-->
                    <Sidebar :kategoriKajian="kategoriKajian" />

                    <!--Content Side-->
                    <div
                        class="col-lg-9 col-md-8 col-sm-12 col-xs-12 pull-right"
                    >
                        <!--Law Section-->
                        <section class="law-section">
                            <div class="text-center">
                                <h2>{{ post.title }}</h2>
                                <!-- {{-- <h5>{{ $post->author }}</h5> --}} -->

                                <p>
                                    By.
                                    <Link
                                        :href="`/authors/${post.author.username}`"
                                        class="text-decoration-none"
                                        >{{ post.author.name }}</Link
                                    >

                                    <!-- {{-- pengecekan gambar kosong atau ada --}} -->
                                </p>

                                <div
                                    v-if="post.image"
                                    style="max-height: 400px; overflow: hidden"
                                >
                                    <img
                                        :src="`/storage/${post.image}`"
                                        width="900"
                                        height="500"
                                        class="card-img-top"
                                        alt="{{ post.title }}"
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

                                <article
                                    class="text-justify my-3"
                                    v-html="post.body"
                                ></article>

                                <Link href="/amal/masjidAlKhasanah"
                                    ><span class="fa fa-angle-left"></span>
                                    &ensp; Kembali ke Postingan</Link
                                >
                            </div>
                        </section>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
