<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";

const props = defineProps({
    title: String,
    active: String,
    kajian: Object,
    pp: Array,
});

if (import.meta.env.DEV) {
    console.log("kajian:", props.kajian);
}
</script>

<template>
    <Layout>
        <!--Page Title-->
        <section
            class="page-title"
            style="background-image: url('/img/Logo3.jpg')"
        >
            <div class="auto-container">
                <h1>Beranda Kajian</h1>
            </div>
        </section>

        <!--Page Info-->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left"><h2>Kajian</h2></div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Kajian</li>
                    </ul>
                </div>
            </div>
        </section>

        <!--News Section-->
        <section class="news-section extended">
            <div class="auto-container">
                <!-- Jika data tersedia -->
                <div v-if="kajian?.data?.length">
                    <div class="row clearfix">
                        <article
                            v-for="post in kajian.data"
                            :key="post.id"
                            class="column featured-news-column col-md-4 col-sm-6 col-xs-12"
                        >
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img
                                        :src="
                                            post.image
                                                ? `/storage/${post.image}`
                                                : 'https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg'
                                        "
                                        width="370"
                                        height="250"
                                        loading="lazy"
                                        class="card-img-top"
                                        :alt="post.title"
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
                                            ).toLocaleDateString("id-ID", {
                                                day: "2-digit",
                                                month: "short",
                                            })
                                        }}
                                    </div>

                                    <div class="tags">
                                        <span class="icon fa fa-tags"></span
                                        >&ensp;
                                        <Link
                                            v-if="post.kategori_kajian"
                                            :href="`/kategori/${post.kategori_kajian.slug}`"
                                        >
                                            {{ post.kategori_kajian.name }}
                                        </Link>
                                    </div>

                                    <h3>
                                        <Link
                                            :href="`/kajian/${post.slug}`"
                                            class="text-dark"
                                        >
                                            {{ post.title }}
                                        </Link>
                                    </h3>

                                    <p class="text">
                                        <small>
                                            <span v-if="post.speaker">
                                                By.
                                                <Link
                                                    :href="`/speaker/kajian/${post.speaker}`"
                                                >
                                                    {{ post.speaker }}
                                                </Link>
                                            </span>
                                            <span v-else>
                                                By
                                                <Link
                                                    v-if="post.author"
                                                    :href="`/authors/kajian/${post.author.username}`"
                                                >
                                                    {{ post.author.name }}
                                                </Link>
                                            </span>
                                            <small class="text-muted">
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
                                            </small>
                                        </small>
                                    </p>

                                    <div class="text">
                                        <p>
                                            {{
                                                post.excerpt.substring(0, 100)
                                            }}...
                                        </p>
                                    </div>

                                    <Link
                                        :href="`/kajian/${post.slug}`"
                                        class="theme-btn read-more"
                                    >
                                        Baca Selengkapnya
                                    </Link>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <!-- Jika data belum ada (loading) -->
                <div v-else-if="kajian === undefined || !kajian.data">
                    <div class="row clearfix">
                        <div
                            v-for="i in 3"
                            :key="i"
                            class="column featured-news-column col-md-4 col-sm-6 col-xs-12"
                        >
                            <div class="inner-box skeleton-box">
                                <div
                                    style="
                                        width: 100%;
                                        height: 250px;
                                        background-color: #eee;
                                        margin-bottom: 10px;
                                    "
                                ></div>
                                <div
                                    style="
                                        height: 20px;
                                        width: 70%;
                                        background-color: #ddd;
                                        margin-bottom: 8px;
                                    "
                                ></div>
                                <div
                                    style="
                                        height: 16px;
                                        width: 90%;
                                        background-color: #ddd;
                                    "
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jika tidak ada post -->
                <p v-else class="text-center fs-4">No Post Found</p>
            </div>
        </section>
    </Layout>
</template>

<style scoped>
.card-img-top {
    width: 370px;
    height: 250px;
    object-fit: cover;
    display: block;
}
</style>
