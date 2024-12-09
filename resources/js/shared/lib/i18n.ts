import i18n from "i18next";
import { initReactI18next } from "react-i18next";
import Backend from "i18next-http-backend";
import intervalPlural from "i18next-intervalplural-postprocessor";
import i18nextHttpBackend from "i18next-http-backend";

const lng = (localStorage.getItem("lang") ?? "ru") as string;

i18n.use(Backend)
    .use(intervalPlural)
    .use(initReactI18next)
    .init({
        lng,
        fallbackLng: "en",
        debug: false,
        backend: {
            backends: [i18nextHttpBackend],
            backendOptions: [
                {
                    expirationTime: 0,
                },
                {
                    loadPath: "/locales/{{lng}}/{{ns}}.json",
                },
            ],
        },
    });

export default i18n;
