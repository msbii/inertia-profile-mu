<template>
    <Layout>
        <div>
            <!-- Page Title -->
            <section
                class="page-title"
                style="background-image: url('img/Logo3.jpg')"
            >
                <div class="auto-container">
                    <h1>Kontak</h1>
                </div>
            </section>

            <!-- Page Info -->
            <section class="page-info">
                <div class="auto-container clearfix">
                    <div class="pull-left">
                        <h2>Kontak</h2>
                    </div>
                    <div class="pull-right">
                        <ul class="bread-crumb clearfix">
                            <li><Link href="/">Beranda</Link></li>
                            <li>Hubungi kami</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section class="contact-section">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div
                            class="info-column column col-lg-12 col-md-4 col-sm-8 col-xs-12"
                        >
                            <!-- Styled Heading -->
                            <div class="styled-heading">
                                <h2>Get Touch With Us</h2>
                            </div>

                            <div class="contact-info">
                                <div class="info-block">
                                    <h3>
                                        <span
                                            class="icon fa fa-map-marker"
                                        ></span>
                                        Address
                                    </h3>
                                    <div class="text">
                                        <p>
                                            Masjid Al Amien RT. 06,
                                            Panggungharjo,<br />Sewon, Bantul,
                                            D.I. Yogyakarta 55188
                                        </p>
                                    </div>
                                </div>
                                <div class="info-block">
                                    <h3>
                                        <span class="icon fa fa-phone"></span>
                                        Phone
                                    </h3>
                                    <div class="text">
                                        <p>
                                            0813 1022 0430 - 0817 7953 1610<br />muhammadiyahpanggungharjo@gmail.com
                                        </p>
                                    </div>
                                </div>
                                <div class="info-block">
                                    <h3>
                                        <span class="icon fa fa-clock-o"></span>
                                        Office Hours
                                    </h3>
                                    <ul class="hours-list">
                                        <li class="clearfix">
                                            <span class="col">Monday</span
                                            ><span class="col"
                                                >09.00-17.00</span
                                            >
                                        </li>
                                        <li class="clearfix">
                                            <span class="col">Tuesday</span
                                            ><span class="col"
                                                >09.00-17.00</span
                                            >
                                        </li>
                                        <li class="clearfix">
                                            <span class="col">Wednesday</span
                                            ><span class="col"
                                                >09.00-17.00</span
                                            >
                                        </li>
                                        <li class="clearfix">
                                            <span class="col">Thursday</span
                                            ><span class="col"
                                                >09.00-17.00</span
                                            >
                                        </li>
                                        <li class="clearfix">
                                            <span class="col">Friday</span
                                            ><span class="col"
                                                >09.00-17.00</span
                                            >
                                        </li>
                                        <li class="clearfix">
                                            <span class="col">Saturday</span
                                            ><span class="col"
                                                >10.00-13.00</span
                                            >
                                        </li>
                                        <li class="clearfix">
                                            <span class="col">Sunday</span
                                            ><span class="col theme_color"
                                                >Close</span
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </Layout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from "@/shared/mainLayout.vue";
const backgroundImage = "/storage/img/Logo3.jpg";
</script>
