<template>
    <div>
        <!-- START FOOTER -->
        <footer class="bg-gray-900 text-gray-300 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8"
                >
                    <!-- Logo & Sosial -->
                    <div>
                        <Link href="/">
                            <img :src="logoSrc" alt="Logo" class="h-12 mb-4" />
                        </Link>
                        <div class="flex space-x-3">
                            <Link
                                v-for="(icon, index) in socialIcons"
                                :key="index"
                                :href="icon.link"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-emerald-600 transition"
                            >
                                <i :class="icon.icon"></i>
                            </Link>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Kategori</h4>
                        <ul class="space-y-2">
                            <li
                                v-for="(item, index) in categories"
                                :key="index"
                            >
                                <Link
                                    :href="item.link"
                                    class="hover:text-emerald-400 transition"
                                    >{{ item.name }}</Link
                                >
                            </li>
                        </ul>
                    </div>

                    <!-- Tentang -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Tentang</h4>
                        <ul class="space-y-2">
                            <li v-for="post in sejarah" :key="post.slug">
                                <Link
                                    :href="'/' + post.slug"
                                    class="hover:text-emerald-400 transition"
                                >
                                    {{ post.title }}
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Ekosistem -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Ekosistem</h4>
                        <ul class="space-y-2">
                            <li v-for="(item, index) in ekosistem" :key="index">
                                <Link
                                    :href="item.link"
                                    class="hover:text-emerald-400 transition"
                                >
                                    {{ item.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">
                            Info Kontak
                        </h4>
                        <div
                            v-for="(info, index) in kontak"
                            :key="index"
                            class="flex items-start space-x-2 mb-3 text-sm"
                        >
                            <span :class="info.icon"></span>
                            <p v-if="info.isLink">
                                <Link
                                    :href="info.link"
                                    class="hover:text-emerald-400 transition"
                                >
                                    {{ info.text }}
                                </Link>
                            </p>
                            <p v-else>{{ info.text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- START FOOTER COPYRIGHT -->
        <div class="bg-gray-800 py-4">
            <div
                class="max-w-7xl mx-auto px-4 text-center text-gray-400 text-sm"
            >
                &copy; {{ new Date().getFullYear() }} Perserikatan Muhammadiyah
            </div>
        </div>
        <!-- END FOOTER COPYRIGHT -->
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: { Link },
    props: { sejarah: Array },
    data() {
        return {
            logoSrc: "/img/Logo2.webp",
            socialIcons: [
                { link: "#", icon: "fab fa-facebook-f" },
                { link: "#", icon: "fab fa-twitter" },
                { link: "#", icon: "fab fa-instagram" },
                { link: "#", icon: "fab fa-youtube" },
                { link: "#", icon: "fab fa-tiktok" },
            ],
            categories: [
                { name: "Muhammadiyah", link: "/view/muhammadiyah" },
                { name: "‘Aisyiyah", link: "/view/aisyiyah" },
                { name: "Kabar", link: "/kabar" },
                { name: "Kajian", link: "/kategori/kajian" },
                { name: "Hubungi Kami", link: "/contact-us" },
            ],
            ekosistem: [
                { name: "WarMA", link: "shop.html" },
                { name: "TK ABA", link: "/amal/tkAba" },
                { name: "Masjid Al Amien", link: "/amal/masjidAlAmien" },
                {
                    name: "Masjid Safinatullah",
                    link: "/amal/masjidSafinatullah",
                },
                { name: "Masjid Baiturohman", link: "/amal/masjidBaiturohman" },
                { name: "Masjid Al Ikhsan", link: "/amal/masjidAlIkhsan" },
                {
                    name: "Mushola Al Khasanah",
                    link: "/amal/musholaAlKhasanah",
                },
                { name: "Mushola Al Hikmah", link: "/amal/musholaAlHikmah" },
            ],
            kontak: [
                {
                    icon: "ti-map",
                    text: "Masjid Al Amien RT. 06, Panggungharjo, Sewon, Bantul, D.I. Yogyakarta 55188",
                },
                { icon: "ti-mobile", text: "0813 1022 0430 - 0817 7953 1610" },
                {
                    icon: "ti-mobile",
                    text: "Contact Whatsapp",
                    isLink: true,
                    link: "tel:+88457845695",
                },
                {
                    icon: "ti-email",
                    text: "muhammadiyahpanggungharjo@yourmail.com",
                },
            ],
        };
    },
};
</script>
