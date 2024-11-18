import { createInertiaApp } from "@inertiajs/react";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import "nprogress/nprogress.css";
import { hydrateRoot } from "react-dom/client";

createInertiaApp({
    progress: {
        delay: 0,
        color: "hsl(var(--nextui-primary))",
    },
    // @ts-ignore
    resolve: (name) => resolvePageComponent(`./pages/${name}/index.tsx`, import.meta.glob("./pages/**/index.tsx")),
    setup({ el, App, props }) {
        hydrateRoot(el, <App {...props} />);
    },
});
