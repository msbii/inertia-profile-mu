<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";

const props = defineProps({
    title: String,
    active: String,
    post: Array,
    category: Array,
    popularKajians: Array,
    latestPosts: Array,
});

// Debugging
console.log("detail kajian:", props.post);
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
                <h1>Detail Kajian</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Kajian</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Detail Kajian</li>
                    </ul>
                </div>
            </div>
        </section>

        <!--Sidebar Page-->
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Content Side-->
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <section
                            class="news-section classic-view blog-details no-padd-top padd-bott-70"
                        >
                            <article class="column featured-news-column">
                                <div
                                    class="inner-box clearfix"
                                    style="font-size: 15px; line-height: 1.7"
                                >
                                    <figure class="image-box">
                                        <div
                                            class="d-flex justify-content-center"
                                        >
                                            <img
                                                v-if="post.image"
                                                :src="`/storage/post-images/original/${post.image}`"
                                                width="750"
                                                height="450"
                                                class="img-fluid"
                                                :alt="
                                                    post.kategori_kajian?.name
                                                "
                                            />
                                            <img
                                                v-else
                                                src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                                width="750"
                                                height="450"
                                                class="img-fluid"
                                                :alt="
                                                    post.kategori_kajian?.name
                                                "
                                            />
                                        </div>
                                        <div class="date">
                                            {{
                                                new Date(
                                                    post.created_at
                                                ).toLocaleDateString("id-ID", {
                                                    day: "2-digit",
                                                    month: "short",
                                                })
                                            }}
                                        </div>
                                    </figure>
                                    <div class="content">
                                        <div class="tags">
                                            <span class="icon fa fa-tags"></span
                                            >&ensp;
                                            <Link
                                                :href="`/kategori/${post.kategori_kajian?.slug}`"
                                            >
                                                {{ post.kategori_kajian?.name }}
                                            </Link>
                                        </div>

                                        <p v-if="post.speaker">
                                            Pembicara:
                                            <Link
                                                :href="`/speaker/kajian/${post.speaker}`"
                                                class="text-decoration-none"
                                            >
                                                {{ post.speaker }}
                                            </Link>
                                        </p>
                                        <p v-else>
                                            By.
                                            <Link
                                                :href="`/authors/kajian/${post.author?.username}`"
                                                class="text-decoration-none"
                                            >
                                                {{ post.author?.name }}
                                            </Link>
                                        </p>

                                        <h3>{{ post.title }}</h3>

                                        <div
                                            class="text"
                                            v-html="post.body"
                                        ></div>

                                        <Link
                                            href="/"
                                            class="btn btn-primary btn-sm mt-2"
                                            >Back to Posts</Link
                                        >

                                        <a
                                            v-if="post.document"
                                            :href="`/download/${post.document}`"
                                        >
                                            <button
                                                class="btn btn-success"
                                                type="button"
                                            >
                                                Download file
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                <div class="post-bottom clearfix">
                                    <ul
                                        class="post-info pull-left clearfix"
                                    ></ul>

                                    <ul
                                        class="share-options pull-right clearfix"
                                    >
                                        <li>Share This Post</li>
                                        <li>
                                            <a
                                                class="fab fa-facebook-f"
                                                href="#"
                                            ></a>
                                        </li>
                                        <li>
                                            <a
                                                class="fab fa-twitter"
                                                href="#"
                                            ></a>
                                        </li>
                                        <li>
                                            <a
                                                class="fab fa-instagram"
                                                href="#"
                                            ></a>
                                        </li>
                                        <li>
                                            <a
                                                class="fab fa-youtube"
                                                href="#"
                                            ></a>
                                        </li>
                                        <li>
                                            <a
                                                class="fab fa-tiktok"
                                                href="#"
                                            ></a>
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </section>
                    </div>
                    <!--End Content Side-->

                    <!--Sidebar-->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <aside class="sidebar">
                            <!-- Popular Categories -->
                            <div
                                class="widget popular-categories sidebar-widget"
                            >
                                <div class="styled-heading">
                                    <h2>Kategori Postingan</h2>
                                </div>

                                <ul class="list">
                                    <li v-for="item in category" :key="item.id">
                                        <Link
                                            class="clearfix"
                                            :href="`/kategori/${item.slug}`"
                                        >
                                            <span class="txt pull-left">{{
                                                item.name
                                            }}</span>
                                        </Link>
                                    </li>
                                </ul>
                            </div>

                            <!-- Recent Posts -->
                            <div class="widget recent-posts sidebar-widget">
                                <div class="styled-heading">
                                    <h2>Latest Posts</h2>
                                </div>

                                <div v-if="latestPosts?.length">
                                    <div
                                        v-for="post in latestPosts"
                                        :key="post.id"
                                        class="post"
                                    >
                                        <div class="post-thumb">
                                            <Link :href="`/posts/${post.slug}`">
                                                <img
                                                    :src="`/storage/${post.image}`"
                                                    :alt="post.title"
                                                />
                                            </Link>
                                        </div>
                                        <h4>
                                            <Link
                                                :href="`/posts/${post.slug}`"
                                                >{{ post.title }}</Link
                                            >
                                        </h4>
                                        <div class="post-info">
                                            <span
                                                class="icon flaticon-business"
                                            ></span>
                                            {{
                                                new Date(
                                                    post.created_at
                                                ).toLocaleDateString("id-ID", {
                                                    day: "2-digit",
                                                    month: "short",
                                                    year: "numeric",
                                                })
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <p v-else>Tidak ada postingan terbaru.</p>
                            </div>
                        </aside>
                    </div>
                    <!--End Sidebar-->
                    <!-- Styled Pagination -->
                </div>
            </div>
        </div>
    </Layout>
</template>
