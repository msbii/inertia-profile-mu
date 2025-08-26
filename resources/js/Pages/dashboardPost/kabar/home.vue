<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";

const props = defineProps({
    title: String,
    active: String,
    posts: Array,
    category: Array,
    latestPosts: Array,
});

// Debugging
console.log("latestPosts:", props.latestPosts);
</script>

<template>
    <Layout>
        <!--Page Title-->
        <section
            class="page-title"
            style="background-image: url('img/Logo3.jpg')"
        >
            <div class="auto-container">
                <h1>Postingan Kategori Kabar</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Kabar</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Kabar</li>
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
                            v-if="posts.length"
                            class="news-section list-view no-padd-top padd-bott-70"
                        >
                            <div class="row">
                                <article
                                    v-for="post in posts"
                                    :key="post.id"
                                    class="column featured-news-column col-md-6 col-lg-6"
                                >
                                    <div class="inner-box clearfix">
                                        <figure class="image-box">
                                            <img
                                                :src="
                                                    post.image
                                                        ? `/storage/post-images/thumbnail/${post.image}`
                                                        : 'https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg'
                                                "
                                                width="370"
                                                height="100"
                                                class="card-img-top"
                                                :alt="post.title"
                                            />
                                            <Link
                                                :href="`/posts/${post.slug}`"
                                                class="default-overlay-outer"
                                            >
                                                <div class="inner">
                                                    <div class="content-layer">
                                                        <div class="link-icon">
                                                            <span
                                                                class="fa fa-link"
                                                            ></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </Link>
                                        </figure>
                                        <div class="right-content">
                                            <div class="content">
                                                <div class="date">
                                                    {{
                                                        new Date(
                                                            post.created_at
                                                        ).toLocaleDateString(
                                                            "id-ID",
                                                            {
                                                                day: "2-digit",
                                                                month: "short",
                                                            }
                                                        )
                                                    }}
                                                </div>
                                                <h3>
                                                    <Link
                                                        :href="`/posts/${post.slug}`"
                                                        >{{ post.title }}</Link
                                                    >
                                                </h3>
                                                <p
                                                    class="text"
                                                    style="font-size: 12px"
                                                >
                                                    <small>
                                                        <template
                                                            v-if="post.speaker"
                                                        >
                                                            By.
                                                            <Link
                                                                :href="`/speaker/${post.speaker}`"
                                                                >{{
                                                                    post.speaker
                                                                }}</Link
                                                            >
                                                            <small
                                                                class="text-muted"
                                                                >{{
                                                                    new Date(
                                                                        post.created_at
                                                                    ).toLocaleDateString(
                                                                        "id-ID"
                                                                    )
                                                                }}</small
                                                            >
                                                        </template>
                                                        <template v-else>
                                                            By
                                                            <Link
                                                                :href="`/authors/${post.author?.username}`"
                                                                >{{
                                                                    post.author
                                                                        ?.name
                                                                }}</Link
                                                            >
                                                            <small
                                                                class="text-muted"
                                                                >{{
                                                                    new Date(
                                                                        post.created_at
                                                                    ).toLocaleDateString(
                                                                        "id-ID"
                                                                    )
                                                                }}</small
                                                            >
                                                        </template>
                                                    </small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </section>

                        <p v-else class="text-center fs-4">No Post Found</p>
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
                                            :href="`/categories/${item.slug}`"
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

                                <div v-if="latestPosts.length">
                                    <div
                                        v-for="post in latestPosts"
                                        :key="post.id"
                                        class="post"
                                    >
                                        <div class="post-thumb">
                                            <Link :href="`/posts/${post.slug}`">
                                                <img
                                                    :src="`/storage/post-images/thumbnail/${post.image}`"
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

                                <!-- <div class="post">
                                    <div class="post-thumb">
                                        <Link href="#"
                                            ><img
                                                :src="'images/resource/thumb-2.jpg'"
                                                alt=""
                                        /></Link>
                                    </div>
                                    <h4>
                                        <Link href="#"
                                            >Very Well performace against
                                            consumers problem</Link
                                        >
                                    </h4>
                                    <div class="post-info">
                                        <span
                                            class="icon flaticon-business"
                                        ></span>
                                        21st Aug 2014
                                    </div>
                                </div>

                                <div class="post">
                                    <div class="post-thumb">
                                        <Link href="#"
                                            ><img
                                                :src="'images/resource/thumb-3.jpg'"
                                                alt=""
                                        /></Link>
                                    </div>
                                    <h4>
                                        <Link href="#"
                                            >We have won against rapped criminal
                                            case</Link
                                        >
                                    </h4>
                                    <div class="post-info">
                                        <span
                                            class="icon flaticon-business"
                                        ></span>
                                        21st Aug 2014
                                    </div>
                                </div> -->
                            </div>
                        </aside>
                    </div>
                    <!--End Sidebar-->
                </div>
            </div>
        </div>
    </Layout>
</template>
