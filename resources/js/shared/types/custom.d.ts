import { IPlayer } from "@/modules/Player/types";

declare module "*.svg" {
    const content: React.FunctionComponent<React.SVGAttributes<SVGElement>> & string;
    export default content;
}

declare module "*.png" {
    const value: any;
    export default value;
}

type UUID<T> = {
    uid: number;
} & T;

type InertiaPageProps = {
    meta: Record<string, any>; // Предположительно мета-данные, уточните тип при необходимости
    social: Record<string, any>; // Данные для социальных сетей, уточните тип
    flash: {
        error?: string | null; // Сообщение об ошибке
        msg?: string | null; // Общее сообщение
        success?: string | null; // Сообщение об успехе
    };
    auth: {
        user: any;
        player: IPlayer | null;
    };
    ziggy: {
        defaults: Record<string, any>;
        namedRoutes: Record<string, string>;
        baseUrl: string;
        baseProtocol: string;
        baseDomain: string;
        location: string;
    };
    locale: string; // Текущая локаль приложения
};
