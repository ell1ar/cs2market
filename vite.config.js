import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.tsx"],
            ssr: "resources/js/ssr.tsx",
            refresh: true,
        }),
        react(),
    ],

    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },

    ssr: {
        noExternal: ["react-toastify"],
    },

    server: {
        host: "0.0.0.0",
        hmr: {
            host: "localhost",
        },
    },
});