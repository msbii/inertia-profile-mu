<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";

const props = defineProps({
    title: String,
    active: String,
    post: Object,
    category: Array,
    popularPosts: Array,
    latestPosts: Array,
});

// Debugging
console.log("detail Postingan:", props.post);
</script>

<template>
    <Layout>
        <!--Page Title-->
        <section
            class="page-title"
            style="background-image: url('/img/Logo3.jpg')"
        >
            <div class="auto-container">
                <h1>Detail Postingan</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Postingan</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Detail Postingan</li>
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
                        <!--News Section-->
                        <section
                            class="news-section classic-view blog-details no-padd-top padd-bott-70"
                        >
                            <!--Column-->
                            <article class="column featured-news-column">
                                <div
                                    class="inner-box clearfix"
                                    style="font-size: 15px; line-height: 1.7"
                                >
                                    <figure class="image-box">
                                        <!-- {{-- pengecekan gambar kosong atau ada --}} -->

                                        <div
                                            v-if="post.image"
                                            class="d-flex justify-content-center"
                                        >
                                            <img
                                                :src="`/storage/${post.image}`"
                                                width="750"
                                                height="450"
                                                class="img-fluid"
                                                alt="{{ post.category.name }}"
                                            />
                                        </div>

                                        <div
                                            v-else
                                            class="d-flex justify-content-center"
                                        >
                                            <img
                                                src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                                width="750"
                                                height="450"
                                                class="img-fluid"
                                                alt="{{ post.category.name }}"
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
                                                :href="`/categories/${post.category.slug}`"
                                                >{{ post.category.name }}</Link
                                            >
                                        </div>
                                        <h3>{{ post.title }}</h3>
                                        <p class="text">
                                            <small>
                                                <p v-if="post.speaker">
                                                    By.
                                                    <Link
                                                        :href="`/speaker/${post.speaker}`"
                                                        class="text-decoration-none"
                                                        >{{
                                                            post.speaker
                                                        }}</Link
                                                    >
                                                    <small class="text-muted">{{
                                                        new Date(
                                                            post.created_at
                                                        ).toLocaleDateString(
                                                            "id-ID",
                                                            {
                                                                day: "2-digit",
                                                                month: "short",
                                                                year: "numeric",
                                                            }
                                                        )
                                                    }}</small>
                                                </p>
                                                <p v-else>
                                                    By
                                                    <Link
                                                        :href="`/authors/${post.author.username}`"
                                                        class="text-decoration-none"
                                                        >{{
                                                            post.author.name
                                                        }}</Link
                                                    >
                                                    <small class="text-muted">{{
                                                        new Date(
                                                            post.created_at
                                                        ).toLocaleDateString(
                                                            "id-ID",
                                                            {
                                                                day: "2-digit",
                                                                month: "short",
                                                                year: "numeric",
                                                            }
                                                        )
                                                    }}</small>
                                                </p>
                                            </small>
                                        </p>

                                        <div
                                            class="text"
                                            v-html="post.body"
                                        ></div>
                                        <!-- {{-- <a href="/download/{{ $post->document }}">
                                            <button class="btn btn-success" type="button">Download file</button>
                                        </a> --}} -->
                                        <br />
                                    </div>
                                </div>
                                <div class="post-bottom clearfix">
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
                                    <h2>Kategori</h2>
                                </div>

                                <ul class="list">
                                    <li v-for="item in category" :key="item.id">
                                        <Link
                                            class="clearfix"
                                            :href="`/categories/${item.slug}`"
                                            ><span class="txt pull-left"
                                                >{{ item.name }}
                                            </span></Link
                                        >
                                    </li>
                                </ul>
                            </div>

                            <!--Popular Post-->
                            <div class="widget popular-posts sidebar-widget">
                                <!-- {{-- <div class="company-history default-column col-lg-4 col-md-12 col-sm-12"> --}} -->
                                <div class="inner-box">
                                    <div class="styled-heading">
                                        <h2>Postingan Populer</h2>
                                    </div>

                                    <div class="row clearfix">
                                        <!--prototype Column-->
                                        <div
                                            class="col-md-12 col-sm-12 col-xs-12"
                                        >
                                            <!--Company Timeline-->
                                            <div class="company-timeline">
                                                <div class="text-center">
                                                    <Link
                                                        :href="`/posts/${popularPosts[0].slug}`"
                                                    >
                                                        <div
                                                            v-if="
                                                                popularPosts[0]
                                                                    .image
                                                            "
                                                            class="d-flex justify-content-center"
                                                        >
                                                            <img
                                                                :src="`/storage/${popularPosts[0].image}`"
                                                                width="380"
                                                                height="300"
                                                                class="img-fluid"
                                                                alt="{{ popularPosts[0].category.name }}"
                                                            />
                                                        </div>

                                                        <div
                                                            v-else
                                                            class="d-flex justify-content-center"
                                                        >
                                                            <img
                                                                src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                                                width="380"
                                                                height="300"
                                                                class="img-fluid"
                                                                alt="{{ popularPosts[0].category.name }}"
                                                            />
                                                        </div>
                                                    </Link>
                                                </div>
                                                <article class="">
                                                    <Link
                                                        :href="`/posts/${popularPosts[0].slug}`"
                                                    >
                                                        <h4>
                                                            {{
                                                                popularPosts[0]
                                                                    .title
                                                            }}
                                                        </h4>
                                                    </Link>
                                                    <Link
                                                        :href="`/posts/${popularPosts[0].slug}`"
                                                    >
                                                        <div class="text">
                                                            <p>
                                                                {{
                                                                    post.excerpt.substring(
                                                                        0,
                                                                        70
                                                                    )
                                                                }}...
                                                            </p>
                                                        </div>
                                                    </Link>
                                                </article>
                                            </div>
                                            <hr class="thick-line" />
                                        </div>

                                        <!--Timeline Column-->
                                        <div
                                            class="timeline-column col-md-12 col-sm-12 col-xs-12"
                                        >
                                            <!--Company Timeline-->
                                            <div class="company-timeline">
                                                <!--Timeline Block-->
                                                <article class="timeline-block">
                                                    <Link
                                                        :href="`/posts/${popularPosts[1].slug}`"
                                                    >
                                                        <div class="year">
                                                            2
                                                            <div class="curve">
                                                                <span
                                                                    class="fa fa-caret-down"
                                                                ></span>
                                                            </div>
                                                        </div>
                                                        <h4>
                                                            {{
                                                                popularPosts[1]
                                                                    .title
                                                            }}
                                                        </h4>
                                                        <div class="text">
                                                            <p>
                                                                {{
                                                                    post.excerpt.substring(
                                                                        0,
                                                                        70
                                                                    )
                                                                }}...
                                                            </p>
                                                        </div>
                                                    </Link>
                                                </article>

                                                <!--Timeline Block-->
                                                <article class="timeline-block">
                                                    <Link
                                                        :href="`/posts/${popularPosts[2].slug}`"
                                                    >
                                                        <div class="year">
                                                            3
                                                            <div class="curve">
                                                                <span
                                                                    class="fa fa-caret-down"
                                                                ></span>
                                                            </div>
                                                        </div>
                                                        <h4>
                                                            {{
                                                                popularPosts[2]
                                                                    .title
                                                            }}r
                                                        </h4>
                                                        <div class="text">
                                                            <p>
                                                                {{
                                                                    post.excerpt.substring(
                                                                        0,
                                                                        70
                                                                    )
                                                                }}...
                                                            </p>
                                                        </div>
                                                    </Link>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Posts -->
                            <div class="widget recent-posts sidebar-widget">
                                <div class="styled-heading">
                                    <h2>Postingan Terbaru</h2>
                                </div>

                                <div
                                    v-for="item in latestPosts"
                                    :key="item.id"
                                    class="post"
                                >
                                    <div class="post-thumb">
                                        <Link :href="`/posts/${item.slug}`"
                                            ><img
                                                :src="`/storage/${item.image}`"
                                                alt=""
                                        /></Link>
                                    </div>
                                    <h4>
                                        <Link :href="`/posts/${item.slug}`">{{
                                            item.title
                                        }}</Link>
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
                        </aside>
                    </div>
                    <!--End Sidebar-->
                </div>
            </div>
        </div>
    </Layout>
</template>
