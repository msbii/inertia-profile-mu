<script setup>
import { defineProps } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
    sejarah: Array,
    kategoriSK: Array,
    kategoriKajian: Array,
    pelaksana: Array,
});

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
                                current: currentPath === '/view/muhammadiyah',
                            }"
                        >
                            <Link href="/view/muhammadiyah"
                                >All Practice Areas</Link
                            >
                        </li>

                        <!-- Sejarah -->
                        <li
                            :class="{
                                current: currentPath.startsWith('/sejarah/'),
                            }"
                            class="dropdown"
                        >
                            <a
                                class="nav-link dropdown-toggle"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                href="#"
                                >Sejarah</a
                            >
                            <ul class="dropdown-menu">
                                <li v-for="post in sejarah" :key="post.slug">
                                    <Link :href="'/' + post.slug">{{
                                        post.title
                                    }}</Link>
                                </li>
                            </ul>
                            <!-- <ul class="dropdown-menu">
                                <li v-for="item in sejarah" :key="item.slug">
                                    <Link :href="`/${item.slug}`">{{
                                        item.title
                                    }}</Link>
                                </li>
                            </ul> -->
                        </li>

                        <li
                            :class="{
                                current: currentPath.startsWith(
                                    '/musyawarah/muhammadiyah'
                                ),
                            }"
                        >
                            <Link href="/musyawarah/muhammadiyah"
                                >Musyawarah Ranting</Link
                            >
                        </li>

                        <!-- Organisasi -->
                        <li
                            class="dropdown"
                            :class="{
                                current:
                                    currentPath.startsWith(
                                        '/sk/muhammadiyah'
                                    ) ||
                                    currentPath.startsWith(
                                        '/struktur/muhammadiyah'
                                    ),
                            }"
                        >
                            <a
                                class="nav-link dropdown-toggle"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                href="#"
                                >Organisasi</a
                            >
                            <ul class="dropdown-menu">
                                <li>
                                    <Link href="/struktur/muhammadiyah"
                                        >Struktur Organisasi</Link
                                    >
                                </li>
                                <li>
                                    <Link href="/struktur/muhammadiyah"
                                        >Biodata Pimpinan</Link
                                    >
                                </li>
                                <li v-for="item in kategoriSK" :key="item.slug">
                                    <Link
                                        :href="`/sk/muhammadiyah/${item.slug}`"
                                        >{{ item.name }}</Link
                                    >
                                </li>
                            </ul>
                        </li>

                        <!-- Kajian -->
                        <li
                            class="dropdown"
                            :class="{
                                current: currentPath.startsWith(
                                    '/kajian/muhammadiyah'
                                ),
                            }"
                        >
                            <a
                                class="nav-link dropdown-toggle"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                href="#"
                                >Kajian</a
                            >
                            <ul class="dropdown-menu">
                                <li
                                    v-for="item in kategoriKajian"
                                    :key="item.slug"
                                >
                                    <Link
                                        :href="`/kajian/muhammadiyah/${item.slug}`"
                                        >{{ item.name }}</Link
                                    >
                                </li>
                            </ul>
                        </li>

                        <!-- Pelaksanaan Program -->
                        <li
                            class="dropdown"
                            :class="{
                                current: currentPath.startsWith(
                                    '/pelaksana/muhammadiyah'
                                ),
                            }"
                        >
                            <a
                                class="nav-link dropdown-toggle"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                href="#"
                                >Pelaksanaan Program</a
                            >
                            <ul class="dropdown-menu">
                                <li v-for="item in pelaksana" :key="item.slug">
                                    <Link
                                        :href="`/pelaksana/muhammadiyah/${item.slug}`"
                                        >{{ item.title }}</Link
                                    >
                                </li>
                            </ul>
                        </li>

                        <li
                            :class="{
                                current: currentPath.startsWith(
                                    '/inventaris/muhammadiyah'
                                ),
                            }"
                        >
                            <Link href="/inventaris/muhammadiyah"
                                >Inventaris</Link
                            >
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Sidebar Widget / Downloads -->
            <div class="widget sidebar-widget downloads">
                <div class="styled-heading"><h2>Our Brochures</h2></div>
                <ul>
                    <!-- Anda bisa menambahkan daftar dokumen di sini -->
                </ul>
            </div>
        </aside>
    </div>
</template>
