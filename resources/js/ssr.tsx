import { createInertiaApp } from "@inertiajs/react";
import createServer from "@inertiajs/react/server";
import ReactDOMServer from "react-dom/server";
import { route } from "ziggy-js";
import { Ziggy } from "./ziggy.js";

createServer((page) =>
    createInertiaApp({
        page,
        render: ReactDOMServer.renderToString,
        resolve: (name) => {
            // @ts-ignore
            const pages = import.meta.glob("./pages/**/index.tsx", {
                eager: true,
            });
            return pages[`./pages/${name}/index.tsx`];
        },
        setup: ({ App, props }) => {
            // @ts-ignore
            global.route = (name, params, absolute, config = Ziggy) => route(name, params, absolute, config);

            return <App {...props} />;
        },
    })
);
