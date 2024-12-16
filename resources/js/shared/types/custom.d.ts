import { IPlayer } from "@/modules/Player/types";

declare module "*.svg" {
    const content: React.FunctionComponent<React.SVGAttributes<SVGElement>> & string;
    export default content;
}

declare module "*.png" {
    const value: any;
    export default value;
}

declare global {
    type UUID<T> = {
        uuid: number;
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
            player: App.Containers.Player.Data.Resources.PlayerResource | null;
        };
        ziggy: {
            defaults: Record<string, any>;
            namedRoutes: Record<string, string>;
            baseUrl: string;
            baseProtocol: string;
            baseDomain: string;
            location: string;
            query: Record<string, any>;
        };
        locale: string; // Текущая локаль приложения
        currency: {
            current: string;
            avaiableList: string[];
        };
    };

    type TPaginate<T> = {
        current_page: number;
        data: T[];
        first_page_url: string;
        from: number | null;
        last_page: number;
        last_page_url: string;
        links: TPaginateLink[];
        next_page_url: string | null;
        path: string;
        per_page: number;
        prev_page_url: string | null;
        to: number | null;
        total: number;
    };

    type TPaginateLink = {
        url: string | null;
        label: string;
        active: boolean;
    };
}
