<script setup>
import { defineProps } from "vue";
import HeaderComponent from "@/Components/headerComponent.vue";
import FooterComponent from "@/Components/footerComponent.vue";
import HeadComponent from "@/Components/headComponent.vue";
import ScriptComponent from "@/Components/scriptComponent.vue";
import { usePage, Link } from "@inertiajs/vue3";

defineProps({
    title: {
        type: String,
        default: "Muhammadiyah",
    },
    locale: {
        type: String,
        default: document.documentElement.lang || "id",
    },
});

// Ambil data sejarah dari Inertia
const page = usePage();
const sejarah = page.props.sejarah || []; // Pastikan tidak undefined
</script>
<template>
    <html :lang="locale">
        <!-- <HeadComponent :title="title" /> -->
        <HeadComponent />

        <body>
            <div class="page-outer-container">
                <div class="page-wrapper">
                    <!-- Preloader -->
                    <!-- <div class="preloader"></div> -->

                    <!-- Main Header -->
                    <HeaderComponent :sejarah="page.props.sejarah" />

                    <!-- Content -->
                    <slot />

                    <!-- Footer -->
                    <FooterComponent :sejarah="page.props.sejarah" />
                </div>
                <!--Page Wrapper End-->
            </div>
            <!--page-outer-container-->

            <!-- Scroll to top -->
            <div
                class="scroll-to-top scroll-to-target"
                data-target=".main-header"
            >
                <span class="fa fa-long-arrow-up"></span>
            </div>

            <!-- Scripts -->
            <ScriptComponent />
        </body>
    </html>
</template>
