import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
            jquery: "jquery/dist/jquery.min.js", // boleh hapus jika tidak dipakai
        },
    },
    build: {
        chunkSizeWarningLimit: 1000, // boleh tetap ini
    },

    vue: {
        template: {
            compilerOptions: {
                isCustomElement: (tag) => tag === "trix-editor",
            },
        },
    },
});
