<template>
    <header class="main-header">
        <div class="top-bar">
            <div class="auto-container clearfix">
                <div class="top-left">
                    <div class="text">{{ currentDate }}</div>
                </div>
                <div class="top-right">
                    <!-- Icons Social Media -->
                    <div class="flex">
                        <Link class="text-white" href="#"
                            ><i class="fab fa-facebook-f"></i
                        ></Link>
                        <Link class="text-white" href="#"
                            ><i class="fab fa-twitter"></i
                        ></Link>
                        <Link class="text-white" href="#"
                            ><i class="fab fa-instagram"></i
                        ></Link>
                        <Link class="text-white" href="#"
                            ><i class="fab fa-youtube"></i
                        ></Link>
                    </div>
                </div>
            </div>
        </div>
        <!--Middle Bar-->

        <!-- Lower Section -->
        <div class="lower-section">
            <div class="auto-container">
                <!--Outer Box-->
                <div class="outer-box clearfix">
                    <!-- Hidden Nav Toggler -->
                    <div class="nav-toggler">
                        <button class="hidden-bar-opener">
                            <span class="icon fa fa-bars"></span>
                        </button>
                    </div>
                    <!-- / Hidden Nav Toggler -->

                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button
                                type="button"
                                class="navbar-toggle"
                                data-toggle="collapse"
                                data-target=".navbar-collapse"
                            >
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation">
                                <li :class="{ current: isActive('/') }">
                                    <Link href="/"
                                        ><img
                                            :src="'/img/Logo.png'"
                                            alt="Logo"
                                        />Muhammadiyah</Link
                                    >
                                </li>
                                <li
                                    class="dropdown"
                                    :class="{ current: isActive('/view/') }"
                                >
                                    <Link href="#">Lingkup</Link>
                                    <ul>
                                        <li>
                                            <Link href="/view/muhammadiyah"
                                                >Muhammadiyah</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/view/aisyiyah"
                                                >‘Aisyiyah</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/view/angkatanMuda"
                                                >Angkatan Muda
                                                Muhammadiyah</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/view/terpadu"
                                                >Terpadu</Link
                                            >
                                        </li>
                                    </ul>
                                </li>
                                <li :class="{ current: isActive('/kabar') }">
                                    <Link href="/kabar">Kabar</Link>
                                </li>
                                <li
                                    :class="{
                                        current: isActive('/kategori/kajian'),
                                    }"
                                >
                                    <Link href="/kategori/kajian">Kajian</Link>
                                </li>

                                <li
                                    :class="{ current: isActive('/sejarah-') }"
                                    class="dropdown"
                                >
                                    <a href="#">Sejarah</a>
                                    <ul>
                                        <li
                                            v-for="post in sejarah"
                                            :key="post.slug"
                                        >
                                            <Link :href="'/' + post.slug">{{
                                                post.title
                                            }}</Link>
                                        </li>
                                    </ul>
                                </li>

                                <li
                                    class="dropdown"
                                    :class="{ current: isActive('/amal/*') }"
                                >
                                    <Link href="#">Amal Usaha</Link>
                                    <ul>
                                        <li>
                                            <Link href="shop.html">WarMA</Link>
                                        </li>
                                        <li>
                                            <Link href="/amal/tkAba"
                                                >TK ABA</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/amal/masjidAlAmien"
                                                >Masjid Al Amien</Link
                                            >
                                        </li>
                                        <li>
                                            <Link
                                                href="/amal/masjidSafinatullah"
                                                >Masjid Safinatullah
                                            </Link>
                                        </li>
                                        <li>
                                            <Link href="/amal/masjidBaiturohman"
                                                >Masjid Baiturohman
                                            </Link>
                                        </li>
                                        <li>
                                            <Link href="/amal/masjidAlIkhsan"
                                                >Masjid Al Ikhsan</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/amal/musholaAlKhasanah"
                                                >Mushola Al Khasanah</Link
                                            >
                                        </li>
                                        <li>
                                            <Link href="/amal/musholaAlHikmah"
                                                >Mushola Al Hikmah</Link
                                            >
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <Link href="/contact-us">Hubungi Kami</Link>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->

                    <div class="search-box">
                        <form @submit.prevent="submitSearch">
                            <div class="form-group">
                                <input
                                    type="search"
                                    v-model="form.search"
                                    placeholder="Cari yang Anda Butuhkan"
                                />
                                <button
                                    type="submit"
                                    class="theme-btn search-btn"
                                >
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div v-if="!auth.user" class="link-box">
                        <Link href="/login" class="theme-btn">Login</Link>
                    </div>
                    <div v-else class="link-box">
                        <li class="dropdown theme-btn">
                            <!-- Jika user sudah login -->
                            <button class="dropdown-toggle">
                                Selamat Datang,
                                <br />
                                {{ auth.user.name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <Link
                                        href="/dashboard"
                                        class="dropdown-item"
                                        >Dashboard</Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        href="/logout"
                                        method="post"
                                        as="button"
                                        class="dropdown-item"
                                    >
                                        Logout
                                    </Link>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <!-- Lower Section End-->
    </header>

    <!-- Hidden Bar -->
    <section class="hidden-bar right-align">
        <div class="hidden-bar-closer">
            <button class="btn"><i class="fa fa-close"></i></button>
        </div>
        <!-- Hidden Bar Wrapper -->
        <div class="hidden-bar-wrapper">
            <!-- .logo -->
            <div class="logo text-center">
                <a href="/"
                    ><img
                        :src="'/img/Logo.png'"
                        alt="Logo"
                        width="200"
                        height="150"
                /></a>
                <!-- <a href="/"><img src="{{ asset('img')}}/Logo.png" alt="" width="200" height="150"></a>			 -->
            </div>
            <!-- /.logo -->

            <!-- .Side-menu -->
            <div class="side-menu">
                <!-- .navigation -->
                <ul class="navigation">
                    <li><Link href="/">Home</Link></li>

                    <li class="dropdown">
                        <Link href="#">Lingkup</Link>
                        <ul class="submenu">
                            <li>
                                <Link href="/view/muhammadiyah"
                                    >Muhammadiyah</Link
                                >
                            </li>
                            <li>
                                <Link href="/view/aisyiyah">‘Aisyiyah</Link>
                            </li>
                            <li>
                                <Link href="/view/angkatan_muda"
                                    >Angkatan Muda Muhammadiyah
                                </Link>
                            </li>
                            <li><Link href="/view/terpadu">Terpadu</Link></li>
                        </ul>
                    </li>
                    <li><Link href="/kabar">Kabar</Link></li>
                    <li><Link href="/kategori/kajian">Kajian</Link></li>
                    <li class="dropdown">
                        <Link href="#">Amal Usaha</Link>
                        <ul class="submenu">
                            <li><Link href="shop.html">WarMA</Link></li>
                            <li><Link href="/amal/tkAba">TK ABA</Link></li>
                            <li>
                                <Link href="/amal/masjidAlAmien"
                                    >Masjid Al Amien</Link
                                >
                            </li>
                            <li>
                                <Link href="/amal/masjidSafinatullah"
                                    >Masjid Safinatullah
                                </Link>
                            </li>
                            <li>
                                <Link href="/amal/masjidBaiturohman"
                                    >Masjid Baiturohman
                                </Link>
                            </li>
                            <li>
                                <Link href="/amal/masjidAlIkhsan"
                                    >Masjid Al Ikhsan</Link
                                >
                            </li>
                            <li>
                                <Link href="/amal/musholaAlKhasanah"
                                    >Mushola Al Khasanah</Link
                                >
                            </li>
                            <li>
                                <Link href="/amal/musholaAlHikmah"
                                    >Mushola Al Hikmah</Link
                                >
                            </li>
                        </ul>
                    </li>
                    <li><Link href="/contact-us">Hubungi Kami</Link></li>
                </ul>
            </div>
            <!-- /.Side-menu -->

            <div class="social-icons">
                <ul>
                    <li><Link> href="#" class="fab fa-facebook-f"></Link></li>
                    <li><Link> href="#" class="fab fa-twitter"></Link></li>
                    <li><Link> href="#" class="fab fa-instagram"></Link></li>
                    <li><Link> href="#" class="fab fa-youtube"></Link></li>
                    <li><Link> href="#" class="fab fa-tiktok"></Link></li>
                </ul>
            </div>
        </div>
        <!-- / Hidden Bar Wrapper -->
    </section>
    <!-- / Hidden Bar -->
</template>

<script setup>
import { computed, ref } from "vue";
import { Link, usePage, useForm } from "@inertiajs/vue3";

// Ambil props dari Laravel
const props = defineProps({
    sejarah: Array, // Data dari Laravel
});

// Ambil data user dari Laravel
const page = usePage();
const auth = page.props.auth;

// Format tanggal sekarang
const currentDate = computed(() =>
    new Date().toLocaleDateString("id-ID", {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric",
    })
);

// Form pencarian
const form = useForm({
    search: "",
});

// Fungsi submit pencarian
const submitSearch = () => {
    form.get("/search", {
        preserveState: true, // Supaya halaman tidak full reload
    });
};

// Fungsi untuk menentukan apakah link aktif
const isActive = (path) => page.url.startsWith(path);

// Debugging
console.log("Data Sejarah:", props.sejarah);
</script>

<style scoped>
/* Tambahkan styling di sini */
</style>
