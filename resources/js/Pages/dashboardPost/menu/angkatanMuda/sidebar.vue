<script setup>
import { defineProps } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const currentPath = usePage().url;
</script>

<template>
    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 pull-left">
        <aside class="sidebar">
            <!-- Sidebar Widget / Boxed Nav -->

            <div class="widget sidebar-widget boxed-nav">
                <nav class="nav-outer">
                    <ul>
                        <li
                            :class="{
                                current: currentPath === '/view/angkatanMuda',
                            }"
                        >
                            <Link :href="`/view/angkatanMuda`"
                                >All Practice Areas</Link
                            >
                        </li>

                        <li
                            :class="{
                                current: currentPath.startsWith(
                                    '/musyawarah/angkatanMuda'
                                ),
                            }"
                        >
                            <Link href="/musyawarah/angkatanMuda"
                                >Musyawarah Ranting</Link
                            >
                        </li>

                        <li
                            :class="{
                                current:
                                    currentPath.startsWith(
                                        'pemudaMuhammadiyah/angkatanMuda*'
                                    ) ||
                                    currentPath.startsWith(
                                        'nasyiatulAisyiyah/angkatanMuda*'
                                    ),
                            }"
                        >
                            <Link
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                >Organisasi</Link
                            >
                            <ul class="dropdown-menu">
                                <li>
                                    <Link
                                        class="dropdown-item"
                                        href="/pemudaMuhammadiyah/angkatanMuda"
                                        >Pemuda Muhammadiyah</Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        class="dropdown-item"
                                        href="/nasyiatulAisyiyah/angkatanMuda"
                                        >Nasyiatul ‘Aisyiyah</Link
                                    >
                                </li>
                            </ul>
                        </li>

                        <li
                            :class="{
                                current: currentPath.startsWith(
                                    '/syiar/angkatanMuda'
                                ),
                            }"
                        >
                            <Link href="/syiar/angkatanMuda"
                                >Syiar Lomba Takbir</Link
                            >
                        </li>

                        <li
                            :class="{
                                current: currentPath.startsWith(
                                    '/baksos/angkatanMuda'
                                ),
                            }"
                        >
                            <Link href="/baksos/angkatanMuda"
                                >Bakti Sosial Idul Adha</Link
                            >
                        </li>
                    </ul>
                </nav>
            </div>

            <!--Sidebar Widget / Downloads-->
            <div class="widget sidebar-widget downloads">
                <div class="styled-heading"><h2>Our Brochures</h2></div>
                <ul>
                    <li>
                        <a href="#"
                            ><span class="icon fa fa-file-pdf-o"></span>
                            Practice Areas.PDF</a
                        >
                    </li>
                    <li>
                        <a href="#"
                            ><span class="icon fa fa-file-pdf-o"></span> Related
                            Law Guides.PDF</a
                        >
                    </li>
                    <li>
                        <a href="#"
                            ><span class="icon fa fa-file-pdf-o"></span> Related
                            Law Guides.PDF</a
                        >
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</template>
