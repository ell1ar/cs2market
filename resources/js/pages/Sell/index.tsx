import { useFormMarketSell } from "@/modules/Market/hooks/useFormMarketSell";
import { useFormPageSell } from "@/modules/Page/hooks";
import SellPanel from "@/modules/Sell/components/Panel";
import SellSidebar from "@/modules/Sell/components/Sidebar";
import Layout from "@/pages/Layout";
import { Link, usePage } from "@inertiajs/react";
import { BreadcrumbItem, Breadcrumbs } from "@nextui-org/react";
import { useEffect } from "react";
import { useTranslation } from "react-i18next";

export type Props = {
    inventoryItems: App.Containers.Market.Data.Resources.InventoryItemResource[];
} & InertiaPageProps;

export default function Sell({}: Props) {
    const { t } = useTranslation();
    const { ziggy, auth } = usePage<Props>().props;

    const formPageSell = useFormPageSell({
        trade_link: ziggy.query.trade_link ?? auth.player?.tradeLink ?? "",
        name: ziggy.query.name ?? "",
    });

    const formMarketSell = useFormMarketSell();

    useEffect(() => {
        if (formPageSell.isDirty) formPageSell.get(route("page.sell"), { preserveState: true });
    }, [formPageSell.data]);

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
                    <h1 className="text-default-foreground text-4xl uppercase">{t("Sell skins CS2")}</h1>
                    <div className="grid grid-cols-12 gap-2 max-w-6xl mx-auto w-full">
                        <SellPanel
                            className="col-span-8"
                            formMarketSell={formMarketSell}
                            formPageSell={formPageSell}
                        />

                        <SellSidebar
                            className="col-span-4"
                            formMarketSell={formMarketSell}
                        />
                    </div>
                </div>
            </section>
        </Layout>
    );
}
