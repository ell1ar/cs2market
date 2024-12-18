import React, { useEffect, useRef } from "react";
import { Link, router } from "@inertiajs/react";
import Layout from "../Layout";
import { BreadcrumbItem, Breadcrumbs } from "@nextui-org/react";
import { useTranslation } from "react-i18next";

const fetchMarketDeposit = (uuid: string) => {
    router.get(
        route("page.marketDeposit", { uuid }),
        {},
        {
            preserveScroll: true,
            preserveState: true,
            only: ["marketDeposit"],
        }
    );
};

export type Props = {
    marketDeposit: App.Containers.Market.Data.Resources.MarketDepositResource;
} & InertiaPageProps;

export default function Deposit({ marketDeposit }: Props) {
    const { t } = useTranslation();
    const intervalId = useRef<NodeJS.Timeout | null>(null);

    useEffect(() => {
        if (intervalId?.current) clearInterval(intervalId.current);
        if (marketDeposit.status !== "proccessing") return;
        intervalId.current = setInterval(() => fetchMarketDeposit(marketDeposit.uuid), 5000);

        return () => {
            clearInterval(intervalId.current!);
        };
    }, [marketDeposit]);

    return (
        <Layout classNames={{ main: "py-10" }}>
            <section className="w-full flex flex-col max-w-6xl mx-auto">
                <Breadcrumbs>
                    <BreadcrumbItem>
                        <Link href="/">{t("Home")}</Link>
                    </BreadcrumbItem>

                    <BreadcrumbItem>{t("Sell skins")}</BreadcrumbItem>
                </Breadcrumbs>

                <div className="flex flex-col items-center">
                    <h1 className="text-default-foreground text-4xl uppercase">{t("Deposit")}</h1>

                    <div className="grid grid-cols-12 gap-2 max-w-6xl mx-auto w-full"></div>
                </div>
            </section>
        </Layout>
    );
}
