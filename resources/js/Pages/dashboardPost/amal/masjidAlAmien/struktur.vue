<script setup>
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
import Sidebar from "@/Pages/dashboardPost/amal/masjidAlAmien/sidebar.vue"; // Sidebar

const props = defineProps({
    title: String,
    active: String,
    kategoriKajian: Array,
    post: Object,
});

// Debugging
console.log("struktur:", props.post);
// console.log("biodata:", props.biodata);
</script>
<template>
    <Layout>
        <!-- Page Title -->
        <section
            class="page-title"
            style="background-image: url('/img/Logo3.jpg')"
        >
            <div class="auto-container">
                <h1>Struktur Masjid Al Amien</h1>
            </div>
        </section>

        <!-- Page Info -->
        <section class="page-info">
            <div class="auto-container clearfix">
                <div class="pull-left">
                    <h2>Struktur Masjid Al Amien</h2>
                </div>
                <div class="pull-right">
                    <ul class="bread-crumb clearfix">
                        <li><Link href="/">Beranda</Link></li>
                        <li>Struktur Masjid Al Amien</li>
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
                            <div class="">
                                <div class="tags">
                                    <span class="icon fa fa-tags"></span>&ensp;
                                    <Link
                                        :href="`/sk/masjidAlAmien/${post.kategori.slug}`"
                                        >{{ post.kategori.name }}</Link
                                    >
                                </div>
                                <h3>{{ post.title }}</h3>
                                <div class="text" v-html="post.body"></div>

                                <!-- {{-- pengecekan gambar kosong atau ada --}} -->

                                <div
                                    v-if="post.image"
                                    style="max-height: 400px; overflow: hidden"
                                >
                                    <img
                                        :src="`/storage/${post.image}`"
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

                                <br />
                            </div>

                            <!--Education-->
                            <div class="education-info">
                                <div class="styled-heading">
                                    <h2>About Education</h2>
                                </div>
                                <ul class="styled-list-three">
                                    <li>
                                        <strong
                                            >University of Oxford School of Law,
                                            J.D., 1968 -</strong
                                        >
                                        Stephen Flemming is a seasoned and its
                                        aggressivee attorneydevotes 100% of his
                                        practice to criminal defense.Gang
                                        Related Attempted Murder to a first time
                                        DUI, he has the experience and knowledge
                                        to handle the broadesting.
                                    </li>
                                    <li>
                                        <strong
                                            >University of Oxford, BA., 1965
                                            -</strong
                                        >
                                        Aggressive attorneydevotes of his
                                        practice seds ut to criminal
                                        defensse.Gang Related Attempted Murdeer
                                        to a first time DUI, he has the
                                        experience and knowledge to handle the
                                        broadesting range of criminal matters is
                                        a long established fact that a reader
                                        will be distracted.
                                    </li>
                                </ul>
                            </div>

                            <!--Bars-->
                            <div class="bars-info">
                                <div class="styled-heading">
                                    <h2>Bar Admissions</h2>
                                </div>
                                <ul class="styled-list-three">
                                    <li>
                                        <strong>District of Mexico -</strong> It
                                        is a long established fact that a reader
                                        will be distracteed by the readable
                                        content of a page when looking at its
                                        layout the point of using lorem Ipsum is
                                        that it has a more-or-less seds normal
                                        distriibution he point of using
                                        admissions in the bar admission.
                                    </li>
                                    <li>
                                        <strong>Watican City -</strong> There
                                        are many variations of passages of Lorem
                                        Ipsum availablee, but the majority have
                                        suffered lawyer alteration in some form,
                                        by injected humour, or randomised words
                                        which don't look even slightly
                                        believable.
                                    </li>
                                </ul>
                            </div>

                            <!--Court-->
                            <div class="court-info">
                                <div class="styled-heading">
                                    <h2>Court Admissions</h2>
                                </div>
                                <ul class="styled-list-three">
                                    <li>
                                        UK Supreme Court - There are many
                                        variations of passages of Lorem Ipsum
                                        available ut, but the majority have
                                        suffered alteration in some form by
                                        injected humour, or randomised words
                                        which don't look even the slightly
                                        believable if you are going to use a
                                        passage of Lorem Ipsums, you need in the
                                        middle the UK Supreme Court.
                                    </li>
                                </ul>
                            </div>

                            <!--Court-->
                            <div class="professional-info">
                                <div class="styled-heading">
                                    <h2>Professional Affiliations</h2>
                                </div>
                                <ul class="styled-list-three">
                                    <li>
                                        <strong
                                            >Board of Director of St.Pauls
                                            Pediatric AIDS Foundation.</strong
                                        >
                                    </li>
                                    <li>
                                        <strong
                                            >Advisory Board, Food and Drug Law
                                            Institute.</strong
                                        >
                                    </li>
                                    <li>
                                        <strong
                                            >Advisory Board, World Food
                                            Regulation Review.</strong
                                        >
                                    </li>
                                </ul>
                            </div>

                            <!--Honors and Awards-->
                            <div class="awards-info">
                                <div class="styled-heading">
                                    <h2>Honors and Awards</h2>
                                </div>
                                <div class="text">
                                    <p>
                                        It is a long established fact that a
                                        reader will be distracted by the
                                        readable content of a pages is when
                                        looking at its layoutt he point sed of
                                        using Lorem Ipsum is that it has a
                                        more-or-less normal distribution of
                                        letters, as opposed to using 'Content
                                        here, content here', making it look like
                                        readable nd a search for lorem ipsum
                                        will uncover in their infancy.
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!--End Content Side-->
                </div>
            </div>
        </div>
    </Layout>
</template>
