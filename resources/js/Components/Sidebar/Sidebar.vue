<template>
    <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden bg-white flex flex-wrap items-center justify-between md:w-64 z-10 py-4 px-6 min-h-screen border-r border-blueGray-200 shadow-none"
    >
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
            <!-- Toggler -->
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                type="button"
                v-on:click="toggleCollapseShow('bg-white py-3 px-6')"
            >
                <i class="fas fa-bars"></i>
            </button>
            <!-- Brand -->
            <Link
                class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                href="/"
            >
                <img
                    :src="`/img/Logo.png`"
                    class="brand-image img-circle elevation-3"
                    width="50"
                    alt="Logo"
                />
                Muhammadiyah
            </Link>
            <!-- User -->
            <ul class="md:hidden items-center flex flex-wrap list-none">
                <li class="inline-block relative">
                    <notification-dropdown />
                </li>
                <li class="inline-block relative">
                    <user-dropdown />
                </li>
            </ul>
            <!-- Collapse -->

            <div
                class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative shadow-none absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1"
                :class="collapseShow"
            >
                <!-- Collapse header -->
                <div
                    class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200"
                >
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <Link
                                class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                                href="/"
                            >
                                Vue Notus
                            </Link>
                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button
                                type="button"
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                v-on:click="toggleCollapseShow('hidden')"
                            >
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-6 mb-4 md:hidden">
                    <div class="mb-3 pt-0">
                        <input
                            type="text"
                            placeholder="Search"
                            class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
                        />
                    </div>
                </form>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Navigation -->

                <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                    <li class="items-center">
                        <Link
                            href="/dashboard/home"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith('/dashboard/home'),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith('/dashboard/home'),
                            }"
                        >
                            <i class="fa-solid fa-gauge mr-2 text-sm"></i>
                            Dashboard
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            href="/dashboard/posts"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith('/dashboard/posts'),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith('/dashboard/posts'),
                            }"
                        >
                            <i class="fas fa-newspaper mr-2 text-sm"></i>
                            Postingan Saya
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            href="/dashboard/kajian"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith('/dashboard/kajian'),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith('/dashboard/kajian'),
                            }"
                        >
                            <i class="bi bi-file-post mr-2 text-sm"></i>
                            Data Kajian
                        </Link>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6
                    class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
                >
                    Administrator
                </h6>
                <!-- Navigation -->

                <ul
                    v-if="auth.user.role == 'Admin'"
                    class="md:flex-col md:min-w-full flex flex-col list-none"
                >
                    <li class="items-center">
                        <Link
                            href="/dashboard/categories"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith(
                                        '/dashboard/categories'
                                    ),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith(
                                        '/dashboard/categories'
                                    ),
                            }"
                        >
                            <i class="bi bi-card-list mr-2 text-sm"></i>
                            Kategori Postingan
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            href="/dashboard/user"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith('/dashboard/user'),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith('/dashboard/user'),
                            }"
                        >
                            <i class="bi bi-person-vcard mr-2 text-sm"></i>
                            Data Pengguna
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            href="/admin/role-requests"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith(
                                        '/admin/role-requests'
                                    ),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith(
                                        '/admin/role-requests'
                                    ),
                            }"
                        >
                            <i class="bi bi-box-arrow-in-down mr-2 text-sm"></i>
                            Role Request
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            href="/dashboard/sejarah"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith('/dashboard/sejarah'),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith('/dashboard/sejarah'),
                            }"
                        >
                            <i
                                class="bi bi-file-earmark-richtext mr-2 text-sm"
                            ></i>
                            Data Sejarah
                        </Link>
                    </li>

                    <!-- <li class="items-center">
                            <Link
                                href="/admin/maps"
                                class="text-xs uppercase py-3 font-bold block"
                                :class="{
                                    'text-emerald-500 hover:text-emerald-600':
                                        $page.url.startsWith('/admin/maps'),
                                    'text-blueGray-700 hover:text-blueGray-500':
                                        !$page.url.startsWith('/admin/maps'),
                                }"
                            >
                                <i
                                    class="fas fa-map-marked mr-2 text-sm"
                                    :class="{
                                        'opacity-75':
                                            $page.url.startsWith('/admin/maps'),
                                        'text-blueGray-300':
                                            !$page.url.startsWith('/admin/maps'),
                                    }"
                                ></i>
                                Data Organisasi
                            </Link>
                        </li> -->

                    <li class="items-center">
                        <!-- Trigger -->
                        <div
                            class="text-xs uppercase py-3 font-bold block cursor-pointer flex justify-between items-center"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith('/admin/maps'),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith('/admin/maps'),
                            }"
                            @click="showDropdown = !showDropdown"
                        >
                            <div class="flex items-center">
                                <i
                                    class="bi bi-menu-button-wide mr-2 text-sm"
                                ></i>
                                Data Organisasi
                            </div>
                            <i
                                class="fas"
                                :class="
                                    showDropdown
                                        ? 'fa-chevron-up'
                                        : 'fa-chevron-down'
                                "
                            ></i>
                        </div>

                        <!-- Dropdown Items -->
                        <ul v-show="showDropdown" class="ml-6 mt-1 space-y-1">
                            <li>
                                <Link
                                    href="/dashboard/sk"
                                    class="block py-1 text-sm text-blueGray-500 hover:text-emerald-600"
                                    :class="{
                                        'text-emerald-500 hover:text-emerald-600':
                                            $page.url.startsWith(
                                                '/dashboard/sk'
                                            ),
                                        'text-blueGray-700 hover:text-blueGray-500':
                                            !$page.url.startsWith(
                                                '/dashboard/sk'
                                            ),
                                    }"
                                >
                                    <i class="bi bi-file-earmark-text"></i>
                                    Data SK
                                </Link>
                            </li>
                            <li>
                                <Link
                                    href="/dashboard/struktur"
                                    class="block py-1 text-sm text-blueGray-500 hover:text-emerald-600"
                                    :class="{
                                        'text-emerald-500 hover:text-emerald-600':
                                            $page.url.startsWith(
                                                '/dashboard/struktur'
                                            ),
                                        'text-blueGray-700 hover:text-blueGray-500':
                                            !$page.url.startsWith(
                                                '/dashboard/struktur'
                                            ),
                                    }"
                                >
                                    <i class="bi bi-newspaper"></i>
                                    Struktur Organisasi
                                </Link>
                            </li>
                            <li>
                                <Link
                                    href="/dashboard/biodataPimpinan"
                                    class="block py-1 text-sm text-blueGray-500 hover:text-emerald-600"
                                    :class="{
                                        'text-emerald-500 hover:text-emerald-600':
                                            $page.url.startsWith(
                                                '/dashboard/biodataPimpinan'
                                            ),
                                        'text-blueGray-700 hover:text-blueGray-500':
                                            !$page.url.startsWith(
                                                '/dashboard/biodataPimpinan'
                                            ),
                                    }"
                                >
                                    <i class="bi bi-person-vcard"></i>
                                    Biodata Pimpinan
                                </Link>
                            </li>
                        </ul>
                    </li>

                    <li class="items-center">
                        <Link
                            href="/dashboard/inventaris"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith(
                                        '/dashboard/inventaris'
                                    ),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith(
                                        '/dashboard/inventaris'
                                    ),
                            }"
                        >
                            <i class="bi bi-inboxes mr-2 text-sm"></i>
                            Inventaris
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            href="/dashboard/pelaksanaanProgram"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith(
                                        '/dashboard/pelaksanaanProgram'
                                    ),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith(
                                        '/dashboard/pelaksanaanProgram'
                                    ),
                            }"
                        >
                            <i class="bi bi-person-video2 mr-2 text-sm"></i>
                            Pelaksanaan Program
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            href="/dashboard/musyawarah"
                            class="text-xs uppercase py-3 font-bold block"
                            :class="{
                                'text-emerald-500 hover:text-emerald-600':
                                    $page.url.startsWith(
                                        '/dashboard/musyawarah'
                                    ),
                                'text-blueGray-700 hover:text-blueGray-500':
                                    !$page.url.startsWith(
                                        '/dashboard/musyawarah'
                                    ),
                            }"
                        >
                            <i class="bi bi-journal-text mr-2 text-sm"></i>
                            Data Musyawarah
                        </Link>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Heading -->
                <h6
                    class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
                >
                    Auth Layout Pages
                </h6>
                <!-- Navigation -->

                <ul
                    class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
                >
                    <li class="items-center">
                        <Link
                            class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                            href="/auth/login"
                        >
                            <i
                                class="fas fa-fingerprint text-blueGray-300 mr-2 text-sm"
                            ></i>
                            Login
                        </Link>
                    </li>

                    <li class="items-center">
                        <Link
                            class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
                            href="/auth/register"
                        >
                            <i
                                class="fas fa-clipboard-list text-blueGray-300 mr-2 text-sm"
                            ></i>
                            Register
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
); }

<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import NotificationDropdown from "@/Components/Dropdowns/NotificationDropdown.vue";
import UserDropdown from "@/Components/Dropdowns/UserDropdown.vue";

// Dropdown toggle untuk sidebar
const collapseShow = ref("hidden");
const auth = usePage().props.auth;

function toggleCollapseShow(classes) {
    collapseShow.value = classes;
}

// Untuk dropdown Data Organisasi
const showDropdown = ref(false);
function toggleDropdown() {
    showDropdown.value = !showDropdown.value;
}
</script>
