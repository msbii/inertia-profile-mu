<script setup>
import { defineProps } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
    kategoriKajian: Array,
});

const currentPath = usePage().url;
</script>

<template>
    <!--Sidebar-->
    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 pull-left">
        <aside class="sidebar">
            <!--Sidebar Widget / Boxed Nav-->
            <div class="widget sidebar-widget boxed-nav">
                <nav class="nav-outer">
                    <ul>
                        <li
                            :class="{
                                current:
                                    currentPath === '/amal/masjidBaiturohman',
                            }"
                        >
                            <Link href="/amal/masjidBaiturohman">Sejarah</Link>
                        </li>

                        <li
                            :class="{
                                current:
                                    currentPath === '/sk/masjidBaiturohman',
                            }"
                        >
                            <Link href="/sk/masjidBaiturohman">SK Ranting</Link>
                        </li>

                        <li
                            :class="{
                                current:
                                    currentPath ===
                                    '/struktur/masjidBaiturohman',
                            }"
                        >
                            <Link href="/struktur/masjidBaiturohman"
                                >Struktur Organisasi</Link
                            >
                        </li>

                        <li
                            :class="{
                                current: currentPath.startsWith(
                                    '/kajian/masjidBaiturohman'
                                ),
                            }"
                        >
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >Kajian</a
                            >
                            <ul class="dropdown-menu">
                                <li
                                    v-for="item in kategoriKajian"
                                    :key="item.id"
                                >
                                    <Link
                                        :href="`/kajian/masjidBaiturohman/${item.slug}`"
                                        >{{ item.name }}</Link
                                    >
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

            <!--Sidebar Widget / Downloads-->
            <!-- {{-- <div class="widget sidebar-widget downloads">
            <div class="styled-heading"><h2>Our Brochures</h2></div>
            <ul>
                <li><a href="#"><span class="icon fa fa-file-pdf-o"></span> Practice Areas.PDF</a></li>
                <li><a href="#"><span class="icon fa fa-file-pdf-o"></span> Related Law Guides.PDF</a></li>
                <li><a href="#"><span class="icon fa fa-file-pdf-o"></span> Related Law Guides.PDF</a></li>
            </ul>
        </div> --}} -->
        </aside>
    </div>
    <!--End Sidebar-->
</template>
