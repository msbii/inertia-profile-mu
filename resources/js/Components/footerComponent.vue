<template>
    <div>
        <!-- START FOOTER -->
        <div class="footer section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="single_footer">
                            <Link href="/"
                                ><img :src="logoSrc" alt="Logo"
                            /></Link>
                            <div class="social_profile">
                                <ul>
                                    <li
                                        v-for="(icon, index) in socialIcons"
                                        :key="index"
                                    >
                                        <Link
                                            :href="icon.link"
                                            :class="icon.class"
                                        >
                                            <i :class="icon.icon"></i>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-6 col-xs-12">
                        <div class="single_footer">
                            <h4>Kategori</h4>
                            <ul>
                                <li
                                    v-for="(item, index) in categories"
                                    :key="index"
                                >
                                    <Link :href="item.link">{{
                                        item.name
                                    }}</Link>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-6 col-xs-12">
                        <div class="single_footer">
                            <h4>Tentang</h4>
                            <ul>
                                <li v-for="post in sejarah" :key="post.slug">
                                    <Link :href="'/' + post.slug">{{
                                        post.title
                                    }}</Link>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-6 col-xs-12">
                        <div class="single_footer">
                            <h4>Ekosistem</h4>
                            <ul>
                                <li
                                    v-for="(item, index) in ekosistem"
                                    :key="index"
                                >
                                    <Link :href="item.link">{{
                                        item.name
                                    }}</Link>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="single_footer">
                            <h4>Info Kontak</h4>
                            <div
                                class="sf_contact"
                                v-for="(info, index) in kontak"
                                :key="index"
                            >
                                <span :class="info.icon"></span>
                                <p v-if="info.isLink">
                                    <Link :href="info.link">{{
                                        info.text
                                    }}</Link>
                                </p>
                                <p v-else>{{ info.text }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- START FOOTER COPYRIGHT -->
        <div class="foot_copy">
            <div class="footer_copyright">
                <p>
                    &copy; {{ new Date().getFullYear() }} Perserikatan
                    Muhammadiyah
                </p>
            </div>
        </div>
        <!-- END FOOTER COPYRIGHT -->
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        sejarah: Array, // Data sejarah dikirim dari Laravel
    },
    data() {
        return {
            logoSrc: "/img/Logo2.webp",
            socialIcons: [
                { link: "#", class: "f_facebook", icon: "fab fa-facebook-f" },
                { link: "#", class: "f_twitter", icon: "fab fa-twitter" },
                { link: "#", class: "f_instagram", icon: "fab fa-instagram" },
                { link: "#", class: "f_youtube", icon: "fab fa-youtube" },
                { link: "#", class: "f_tiktok", icon: "fab fa-tiktok" },
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
