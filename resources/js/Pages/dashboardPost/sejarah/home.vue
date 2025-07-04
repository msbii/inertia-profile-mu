<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";

const props = defineProps({
    title: String,
    active: String,
    post: Object,
});

// Debugging
console.log("Sejarah:", props.post);
</script>

<template>
    <Layout>
        <!--Page Title-->
        <section
            class="page-title"
            style="background-image: url('img/Logo3.jpg')"
        >
            <!-- <img :src="'/img/Logo3.jpg'" alt="" /> -->
            <div class="auto-container">
                <h1>Sejarah</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Sejarah</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Sejarah</li>
                    </ul>
                </div>
            </div>
        </section>

        <!--Gallery Single-->
        <section class="portfolio-details">
            <div class="auto-container">
                <!--Image Carousel-->
                <div class="image-carousel-outer">
                    <div class="post-option">
                        <a href="#" class="theme-btn add-fav"
                            ><span class="fa fa-heart-o"></span><br />5</a
                        >
                        <a href="#" class="theme-btn share-btn"
                            ><span class="fa fa-share-alt"></span><br />Share</a
                        >
                    </div>

                    <!-- Image Check -->
                    <div
                        style="max-height: 400px; overflow: hidden"
                        v-if="post.image"
                    >
                        <img
                            :src="`/storage/${post.image}`"
                            width="1170"
                            height="700"
                            class="card-img-top"
                            :alt="post.title"
                        />
                    </div>
                    <img
                        v-else
                        src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                        width="1170"
                        height="700"
                        class="card-img-top"
                        alt="Default Image"
                    />
                </div>

                <div class="post-content">
                    <div class="row clearfix">
                        <!--Text Column-->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="styled-heading">
                                <h2>{{ post.title }}</h2>
                            </div>
                            <div
                                class="text-justify"
                                style="font-size: 18px; line-height: 1.7"
                                v-html="post.body"
                            ></div>
                            <!-- {{-- <a href="/" class"d-block mt-3"> <span class="fa fa-angle-left"></span> &ensp; Kembali ke Postingan</a> --}} -->
                        </div>
                    </div>
                </div>

                <!--Post Controls-->
                <nav class="post-controls">
                    <ul>
                        <li class="prev">
                            <Link href="/"
                                ><span class="fa fa-angle-left"></span> &ensp;
                                Kembali ke Postingan</Link
                            >
                        </li>
                        <!-- {{-- <li><a href="#"><span class="icon fa fa-th"></span></a></li> -->
                        <li class="next">
                            <Link href="#"
                                >Next One &ensp;
                                <span class="fa fa-angle-right"></span
                            ></Link>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </Layout>
</template>
