<script setup>
import { ref, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
import debounce from "lodash.debounce";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/swiper-bundle.css";
import { Navigation, Autoplay, EffectFade } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/effect-fade";

const { popularPosts } = usePage().props;

const props = defineProps({
    title: String,
    active: String,
    posts: Object,
    latestPosts: Array,
    popularPosts: Array,
    showKabar: Array,
    showHukum: Array,
    showKajian: Array,
    filters: Object,
});

const search = ref(props.filters.search || "");

const updateSearch = debounce(() => {
    router.get(
        "/",
        {
            search: search.value,
            category: props.filters.category,
            user: props.filters.user,
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
}, 400);

watch(search, updateSearch);

// Debugging
console.log("posts:", props.posts);
</script>

<template>
    <Layout>
        <div v-if="loading">
            <div class="auto-container">
                <div class="row clearfix">
                    <div
                        v-for="i in 3"
                        :key="i"
                        class="column featured-news-column col-md-4 col-sm-6 col-xs-12"
                    >
                        <div class="inner-box skeleton-box">
                            <div class="image-placeholder"></div>
                            <div class="text-placeholder short"></div>
                            <div class="text-placeholder long"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else-if="posts.data.length">
            <!--Styled Heading-->
            <div class="styled-heading centered">
                <h5></h5>
            </div>

            <!--News Section-->
            <section class="news-section extended">
                <div class="auto-container">
                    <div class="row clearfix">
                        <!-- {{-- @foreach($posts->skip(1) as $post) --}} -->

                        <!--Column-->
                        <article
                            v-for="post in posts.data"
                            :key="post.id"
                            class="column featured-news-column col-md-4 col-sm-6 col-xs-12"
                        >
                            <div class="inner-box">
                                <figure class="image-box">
                                    <!-- {{-- pengecekan gambar kosong atau ada --}} -->

                                    <img
                                        v-if="post.image"
                                        :src="`/storage/post-images/thumbnail/${post.image}`"
                                        width="370"
                                        height="250"
                                        class="card-img-top"
                                        alt="{{ post.title }}"
                                    />
                                    <!-- <img
                                        v-if="post.image"
                                        :src="`/storage/${post.image}`"
                                        width="370"
                                        height="250"
                                        class="card-img-top"
                                        alt="{{ post.title }}"
                                    /> -->

                                    <img
                                        v-else
                                        src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                        width="370"
                                        height="250"
                                        class="card-img-top"
                                        alt="{{ post.title }}"
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
                                            :href="`/categories/${post.category?.slug}`"
                                            >{{ post.category?.name }}</Link
                                        >
                                    </div>
                                    <h3>
                                        <Link
                                            :href="`/posts/${post.slug}`"
                                            class="text-dark"
                                            >{{ post.title }}</Link
                                        >
                                    </h3>
                                    <p class="text text-lg leading-relaxed">
                                        <small>
                                            <span v-if="post.speaker">
                                                By.
                                                <Link
                                                    :href="`/speaker/${post.speaker}`"
                                                    class="text-decoration-none"
                                                    >{{ post.speaker }}</Link
                                                >
                                                <small class="text-muted">{{
                                                    new Date(
                                                        post.created_at
                                                    ).toLocaleDateString(
                                                        "id-ID",
                                                        {
                                                            day: "2-digit",
                                                            month: "short",
                                                        }
                                                    )
                                                }}</small>
                                            </span>
                                            <span v-else>
                                                By
                                                <Link
                                                    :href="`/authors/${post.author?.username}`"
                                                    class="text-decoration-none"
                                                    >{{
                                                        post.author?.name
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
                                                        }
                                                    )
                                                }}</small>
                                            </span>
                                        </small>
                                    </p>
                                    <div class="text text-lg leading-relaxed">
                                        <p>
                                            {{
                                                post.excerpt.substring(0, 100)
                                            }}...
                                        </p>
                                    </div>
                                    <Link
                                        :href="`/posts/${post.slug}`"
                                        class="theme-btn read-more"
                                        >Baca Selengkapnya</Link
                                    >
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>
        <p v-else class="text-center fs-4">No Post Found</p>

        <!-- link pagination -->
        <!--Sidebar Page-->
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Content Side-->
                    <div
                        class="col-lg-9 col-md-8 col-sm-12 col-xs-12 pull-left"
                    >
                        <div class="styled-heading"><h3>Kabar Terbaru</h3></div>

                        <!--News Section-->
                        <div v-if="showKabar.length">
                            <section
                                class="news-section list-view no-padd-top padd-bott-70"
                            >
                                <div class="row">
                                    <!-- Tambahkan wrapper row -->

                                    <!--Column-->
                                    <article
                                        v-for="post in showKabar"
                                        :key="post.id"
                                        class="column featured-news-column col-md-6 col-lg-6"
                                    >
                                        <!-- Menambahkan kelas grid untuk dua kolom -->
                                        <div class="inner-box clearfix">
                                            <figure class="image-box">
                                                <!-- {{-- pengecekan gambar kosong atau ada --}} -->

                                                <img
                                                    v-if="post.image"
                                                    :src="`/storage/${post.image}`"
                                                    width="370"
                                                    height="100"
                                                    class="card-img-top"
                                                    alt="{{ post.title }}"
                                                />

                                                <img
                                                    v-else
                                                    src="https://storage.googleapis.com/a1aa/image/fYtaLxmXcWwZE6OgwpSCiZjC55SLkvIj3QQshe5WZGwAookTA.jpg"
                                                    width="370"
                                                    height="100"
                                                    class="card-img-top"
                                                    alt="{{ post.title }}"
                                                />

                                                <Link
                                                    :href="`/posts/${post.slug}`"
                                                    class="default-overlay-outer"
                                                >
                                                    <div class="inner">
                                                        <div
                                                            class="content-layer"
                                                        >
                                                            <div
                                                                class="link-icon"
                                                            >
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
                                                            >{{
                                                                post.title
                                                            }}</Link
                                                        >
                                                    </h3>
                                                    <div class="text">
                                                        <Link
                                                            :href="`/posts/${post.slug}`"
                                                        >
                                                            <p>
                                                                {{
                                                                    post.description.substring(
                                                                        0,
                                                                        100
                                                                    )
                                                                }}...
                                                            </p>
                                                        </Link>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- Styled Pagination -->
                            </section>
                        </div>

                        <p v-else class="text-center fs-4">No Post Found</p>
                    </div>
                    <!--End Content Side-->

                    <!--Sidebar-->
                    <div
                        class="col-lg-3 col-md-4 col-sm-12 col-xs-12 pull-right"
                    >
                        <aside class="sidebar">
                            <!-- Recent Posts -->
                            <div class="widget recent-posts sidebar-widget">
                                <div class="styled-heading">
                                    <h3>Postingan Populer</h3>
                                </div>

                                <div
                                    v-for="post in popularPosts"
                                    :key="post.id"
                                    class="post"
                                >
                                    <div class="post-thumb">
                                        <Link :href="`/posts/${post.slug}`"
                                            ><img
                                                :src="`/storage/${post.image}`"
                                                alt=""
                                        /></Link>
                                    </div>
                                    <h4>
                                        <Link :href="`/posts/${post.slug}`">{{
                                            post.title
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
                </div>
                <hr />
            </div>
        </div>

        <div class="auto-container">
            <div class="row clearfix">
                <!--Content Side-->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="styled-heading"><h4>Hukum Islam</h4></div>

                    <div v-if="showHukum.length">
                        <!--News Section-->
                        <section
                            class="news-section list-view no-padd-top padd-bott-70"
                        >
                            <div class="news-wrapper">
                                <!--Article-->
                                <article
                                    v-for="post in showHukum"
                                    :key="post.id"
                                    class="featured-news-horizontal mb-4"
                                >
                                    <figure class="image-box">
                                        <!-- {{-- Pengecekan gambar kosong atau ada --}} -->

                                        <img
                                            v-if="post.image"
                                            :src="`/storage/post-images/thumbnail/${post.image}`"
                                            class="image"
                                            alt="{{ post.title }}"
                                        />

                                        <img
                                            v-else
                                            src="https://images.unsplash.com/photo-1417325384643-aac51acc9e5d?q=75&fm=jpg&w=1080&fit=max"
                                            class="image"
                                            alt="{{ post.title }}"
                                        />
                                    </figure>
                                    <div class="right-content">
                                        <div class="content">
                                            <h3>
                                                <Link
                                                    :href="`/posts/${post.slug}`"
                                                    >{{ post.title }}</Link
                                                >
                                            </h3>
                                            <small class="text-muted"
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
                                                }}
                                            </small>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </section>
                    </div>
                    <p v-else class="text-center fs-4">No Post Found</p>
                </div>
                <!--End Content Side-->

                <!--Content Side-->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="styled-heading"><h4>Kajian</h4></div>

                    <div v-if="showKajian.length">
                        <!--News Section-->
                        <section
                            class="news-section list-view no-padd-top padd-bott-70"
                        >
                            <div class="news-wrapper">
                                <!--Article-->
                                <article
                                    v-for="post in showKajian"
                                    :key="post.id"
                                    class="featured-news-horizontal mb-4"
                                >
                                    <figure class="image-box">
                                        <!-- {{-- Pengecekan gambar kosong atau ada --}} -->

                                        <img
                                            v-if="post.image"
                                            :src="`/storage/${post.image}`"
                                            class="image"
                                            alt="{{ post.title }}"
                                        />

                                        <img
                                            v-else
                                            src="https://images.unsplash.com/photo-1417325384643-aac51acc9e5d?q=75&fm=jpg&w=1080&fit=max"
                                            class="image"
                                            alt="{{ post.title }}"
                                        />
                                    </figure>
                                    <div class="right-content">
                                        <div class="content">
                                            <h3>
                                                <Link
                                                    :href="`/posts/${post.slug}`"
                                                    >{{ post.title }}</Link
                                                >
                                            </h3>
                                            <small class="text-muted">{{
                                                new Date(
                                                    post.created_at
                                                ).toLocaleDateString("id-ID", {
                                                    day: "2-digit",
                                                    month: "short",
                                                    year: "numeric",
                                                })
                                            }}</small>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </section>
                    </div>

                    <p v-else class="text-center fs-4">No Post Found</p>
                </div>
                <!--End Content Side-->

                <!--Content Side-->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="styled-heading"><h4>Kabar Terbaru</h4></div>

                    <div v-if="showKabar.length">
                        <!--News Section-->
                        <section
                            class="news-section list-view no-padd-top padd-bott-70"
                        >
                            <div class="news-wrapper">
                                <!--Article-->
                                <article
                                    v-for="post in showKabar"
                                    :key="post.id"
                                    class="featured-news-horizontal mb-4"
                                >
                                    <figure class="image-box">
                                        <!-- {{-- Pengecekan gambar kosong atau ada --}} -->

                                        <img
                                            v-if="post.image"
                                            :src="`/storage/${post.image}`"
                                            class="image"
                                            alt="{{ post.title }}"
                                        />

                                        <img
                                            src="https://images.unsplash.com/photo-1417325384643-aac51acc9e5d?q=75&fm=jpg&w=1080&fit=max"
                                            class="image"
                                            alt="{{ post.title }}"
                                        />
                                    </figure>
                                    <div class="right-content">
                                        <div class="content">
                                            <h3>
                                                <Link
                                                    :href="`/posts/${post.slug}`"
                                                    >{{ post.title }}</Link
                                                >
                                            </h3>
                                            <small class="text-muted">{{
                                                new Date(
                                                    post.created_at
                                                ).toLocaleDateString("id-ID", {
                                                    day: "2-digit",
                                                    month: "short",
                                                    year: "numeric",
                                                })
                                            }}</small>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </section>
                    </div>

                    <p v-else class="text-center fs-4">No Post Found</p>
                </div>
                <!--End Content Side-->
            </div>
        </div>
    </Layout>
</template>
