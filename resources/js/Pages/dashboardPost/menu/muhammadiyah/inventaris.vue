<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
import Sidebar from "@/Pages/dashboardPost/menu/muhammadiyah/sidebar.vue"; // Sidebar

const props = defineProps({
    title: String,
    active: String,
    kategoriKajian: Array,
    kategoriSK: Array,
    sejarah: Array,
    pelaksana: Array,
    inventaris: Object,
});

// Debugging
console.log("Inventaris:", props.inventaris);
</script>
<template>
    <Layout>
        <!-- Page Title -->
        <section
            class="page-title"
            style="background-image: url('/img/Logo3.jpg')"
        >
            <div class="auto-container">
                <h1>Lingkup Muhammadiyah</h1>
            </div>
        </section>

        <!-- Page Info -->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left">
                    <h2>Lingkup Muhammadiyah</h2>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Inventaris Muhammadiyah</li>
                    </ul>
                </div>
            </div>
        </section>

        <!--Sidebar Page-->
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">
                    <!--Sidebar-->
                    <Sidebar
                        :sejarah="sejarah"
                        :kategoriSK="kategoriSK"
                        :kategoriKajian="kategoriKajian"
                        :pelaksana="pelaksana"
                    />

                    <!--Content Side-->
                    <div
                        class="col-lg-9 col-md-8 col-sm-12 col-xs-12 pull-right"
                    >
                        <!--News Section-->
                        <section
                            v-if="inventaris.length"
                            class="news-section list-view no-padd-top padd-bott-70"
                        >
                            <div class="row">
                                <!-- Tambahkan wrapper row -->

                                <!--Column-->
                                <article
                                    v-for="post in inventaris"
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
                                                :href="`/inventaris/muhammadiyah/${post.slug}`"
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
                                                        :href="`/inventaris/muhammadiyah/${post.slug}`"
                                                        >{{ post.title }}</Link
                                                    >
                                                </h3>
                                                <div class="text">
                                                    <Link
                                                        :href="`/inventaris/muhammadiyah/${post.slug}`"
                                                    >
                                                        <p
                                                            v-html="
                                                                post.description
                                                            "
                                                        ></p>
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <!-- Styled Pagination -->
                            <!-- {{-- <div class="">
            {{ $inventaris->links() }}
        </div> --}} -->
                        </section>

                        <p v-else class="text-center fs-4">No Post Found</p>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
