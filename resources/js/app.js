import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

// import "@/assets/styles/tailwind.css"; // atau file CSS dari Notus Admin kamu
// import "../css/app.css"; // default laravel vite + tailwind
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import "@fortawesome/fontawesome-free/css/all.min.css";
import "toastr/build/toastr.min.css";
import "toastr/build/toastr.min.js";

// Impor jQuery secara eksplisit
import $ from "jquery";
window.$ = window.jQuery = $;

// Impor Bootstrap jika dibutuhkan oleh AdminLTE
import "bootstrap/dist/js/bootstrap.bundle.min.js";

// Tambahkan ini
import "@fortawesome/fontawesome-free/css/all.min.css";

// import axios from "axios";

// axios.defaults.headers.common["X-CSRF-TOKEN"] = document
//     .querySelector('meta[name="csrf-token"]')
//     .getAttribute("content");

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});

console.log("Vue berhasil dimuat!");
