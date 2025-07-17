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
                        <button
                            class="hidden-bar-opener"
                            @click="toggleHiddenBar"
                        >
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
                                    v-model="search"
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
                    <!-- Kalau sudah login -->
                    <div v-else>
                        <div v-if="auth.user.role == 'Pengunjung'">
                            <!-- <div v-if="user.role === 'pengunjung'"> -->
                            <button
                                ref="btnDropdownRef"
                                @click="toggleDropdown"
                                class="link-box"
                            >
                                <span class="theme-btn"
                                    >Hai, {{ auth.user.name }}</span
                                >
                            </button>

                            <div
                                ref="popoverDropdownRef"
                                class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                                :class="{
                                    hidden: !dropdownPopoverShow,
                                    block: dropdownPopoverShow,
                                }"
                            >
                                <button
                                    class="btn btn-secondary"
                                    v-if="
                                        // user.role_requests?.status == 'pending'

                                        auth.user.role_request?.status ===
                                        'pending'
                                    "
                                    disabled
                                >
                                    Request Pending
                                </button>
                                <button
                                    v-else
                                    class="btn btn-primary"
                                    @click="requestRole"
                                >
                                    Request Admin Role
                                </button>
                                <div
                                    class="h-0 my-2 border border-solid border-blueGray-100"
                                ></div>
                                <Link
                                    href="/logout"
                                    method="post"
                                    as="button"
                                    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                >
                                    Logout
                                </Link>
                            </div>
                        </div>
                        <div v-else>
                            <button
                                ref="btnDropdownRef"
                                @click="toggleDropdown"
                                class="link-box"
                            >
                                <span class="theme-btn"
                                    >Halo, {{ auth.user.name }}</span
                                >
                            </button>

                            <div
                                ref="popoverDropdownRef"
                                class="bg-white text-lg z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                                :class="{
                                    hidden: !dropdownPopoverShow,
                                    block: dropdownPopoverShow,
                                }"
                            >
                                <Link
                                    href="/dashboard/home"
                                    class="text-lg py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                >
                                    My Dashboard
                                </Link>
                                <div
                                    class="h-0 my-2 border border-solid border-blueGray-100"
                                ></div>
                                <Link
                                    href="/logout"
                                    method="post"
                                    as="button"
                                    class="text-lg py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                                >
                                    Logout
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Lower Section End-->
    </header>

    <!-- Hidden Bar -->
    <!-- <section class="hidden-bar right-align" v-show="true"> -->
    <section :class="['hidden-bar right-align', { show: showHiddenBar }]">
        <!-- <button class="btn" @click="closeHiddenBar"> -->
        <div class="hidden-bar-closer">
            <button class="btn" @click="toggleHiddenBar">
                <i class="fa fa-close"></i>
            </button>
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
import { computed, ref, onMounted, watch } from "vue";
import { Link, usePage, useForm, router } from "@inertiajs/vue3";
import { createPopper } from "@popperjs/core";
import debounce from "lodash.debounce";

// Ambil props dari Laravel
const props = defineProps({
    sejarah: Array, // Data dari Laravel
});

// Ambil data user dari Laravel
const page = usePage();
// const auth = page.props.auth;
// Ambil data user dari Inertia
const auth = usePage().props.auth;
const user = usePage().props.auth.user;
// state

const requestRole = () => {
    router.post("/request-role");
};
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
// const form = useForm({
//     search: "",
// });
// const form = ref({
//   search: '',
// })
const search = ref("");

// Fungsi submit pencarian
// const submitSearch = () => {
//     form.get("/search", {
//         preserveState: true, // Supaya halaman tidak full reload
//     });
// };

// function submitSearch() {
//   router.get('/search', { q: form.value.search })
// }

search.value = page.props.filters?.search || "";

const updateSearch = debounce(() => {
    router.get(
        "/",
        {
            search: search.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
}, 400);

watch(search, updateSearch);

function submitSearch() {
    updateSearch();
}

// Fungsi untuk menentukan apakah link aktif
const isActive = (path) => page.url.startsWith(path);

// Debugging
console.log("Data Sejarah:", props.sejarah);

const dropdownPopoverShow = ref(false);
const btnDropdownRef = ref(null);
const popoverDropdownRef = ref(null);

// Toggle dropdown
function toggleDropdown(event) {
    event.preventDefault();
    dropdownPopoverShow.value = !dropdownPopoverShow.value;

    if (dropdownPopoverShow.value) {
        createPopper(btnDropdownRef.value, popoverDropdownRef.value, {
            placement: "bottom-start",
        });
    }
}

const showHiddenBar = ref(true);
// Saat halaman dimuat, ambil dari localStorage
onMounted(() => {
    const saved = localStorage.getItem("showHiddenBar");
    showHiddenBar.value = saved === "true";
});

// Simpan ke localStorage tiap kali berubah
watch(showHiddenBar, (val) => {
    localStorage.setItem("showHiddenBar", val);
});

const toggleHiddenBar = () => {
    showHiddenBar.value = !showHiddenBar.value;
    console.log("Toggled:", showHiddenBar.value);
};
// methods
// function toggleHiddenBar() {
//     showHiddenBar.value = !showHiddenBar.value;
//     console.log("Toggled:", showHiddenBar.value);
// }
function closeHiddenBar() {
    showHiddenBar.value = false;
}
</script>
