<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
import Sidebar from "@/Pages/dashboardPost/amal/masjidAlIkhsan/sidebar.vue"; // Sidebar

const props = defineProps({
    title: String,
    active: String,
    kategoriKajian: Array,
    posts: Array,
});

// Debugging
console.log("kajian:", props.posts);
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
                <h1>Kajian Masjid Al Ikhsan</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Kajian Masjid Al Ikhsan</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Kajian</li>
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
                        <!--practice Areas Section-->
                        <section class="practice-areas">
                            <div v-if="posts.length" class="row clearfix">
                                <!--Column-->
                                <article
                                    v-for="post in posts"
                                    :key="post.id"
                                    class="column featured-news-column col-md-4 col-sm-6 col-xs-12"
                                >
                                    <div class="inner-box">
                                        <figure class="image-box">
                                            <!-- {{-- pengecekan gambar kosong atau ada --}} -->

                                            <img
                                                v-if="post.image"
                                                :src="`/storage/${post.image}`"
                                                width="370"
                                                height="250"
                                                class="card-img-top"
                                                alt="{{ post.title }}"
                                            />

                                            <img
                                                v-else
                                                src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                                width="370"
                                                height="250"
                                                class="card-img-top"
                                                alt="{{ post.title }}"
                                            />

                                            <Link
                                                :href="`/kajian/${post.slug}`"
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

                                            <div class="tags">
                                                <span
                                                    class="icon fa fa-tags"
                                                ></span
                                                >&ensp;
                                                <Link
                                                    :href="`/kategori/${post.kategori_kajian.slug}`"
                                                    >{{
                                                        post.kategori_kajian
                                                            .name
                                                    }}</Link
                                                >
                                            </div>
                                            <h3>
                                                <Link
                                                    :href="`/kajian/${post.slug}`"
                                                    class="text-dark"
                                                    >{{ post.title }}</Link
                                                >
                                            </h3>
                                            <p class="text">
                                                <small>
                                                    <div v-if="post.speaker">
                                                        By.
                                                        <Link
                                                            :href="`/speaker/kajian/${post.speaker}`"
                                                            class="text-decoration-none"
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
                                                                    "id-ID",
                                                                    {
                                                                        day: "2-digit",
                                                                        month: "short",
                                                                        year: "numeric",
                                                                    }
                                                                )
                                                            }}</small
                                                        >
                                                    </div>
                                                    <div v-else>
                                                        By
                                                        <Link
                                                            :href="`/authors/kajian/${post.author.username}`"
                                                            class="text-decoration-none"
                                                            >{{
                                                                post.author.name
                                                            }}</Link
                                                        >
                                                        <small
                                                            class="text-muted"
                                                            >{{
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
                                                            }}</small
                                                        >
                                                    </div>
                                                </small>
                                            </p>
                                            <div class="text">
                                                <Link
                                                    :href="`/kajian/${post.slug}`"
                                                >
                                                    <p>
                                                        {{
                                                            post.excerpt.substring(
                                                                0,
                                                                100
                                                            )
                                                        }}...
                                                    </p>
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <p v-else class="text-center fs-4">No Post Found</p>

                            <!-- Styled Pagination -->
                            <!-- <div class="">
                                    {{ $posts->links() }}
                                </div> -->
                        </section>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
