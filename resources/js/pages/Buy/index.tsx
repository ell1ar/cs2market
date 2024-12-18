import Pagination from "@/components/Pagination";
import Items from "@/modules/Buy/components/Items";
import SidebarFilters from "@/modules/Buy/components/SidebarFilters";
import TopFilters from "@/modules/Buy/components/TopFilters";
import { useQueryFilter } from "@/modules/Filter/hooks/useQueryFilter";
import { useFormMarketBuy } from "@/modules/Market/hooks/useFormMarketBuy";
import Layout from "@/pages/Layout";
import { Link, router } from "@inertiajs/react";
import { BreadcrumbItem, Breadcrumbs } from "@nextui-org/react";
import { useEffect, useLayoutEffect, useState } from "react";
import { useTranslation } from "react-i18next";

type Props = {
    checkboxFiltersJson?: Record<string, any>;
    paginate: TPaginate<App.Containers.Market.Data.Resources.MarketItemResource>;
} & InertiaPageProps;

export default function Buy({ checkboxFiltersJson, paginate }: Props) {
    const { t } = useTranslation();
    const [isLoading, setIsLoading] = useState(false);
    const { changeQueryParams, isDirty, queryParams } = useQueryFilter();
    const formMarketBuy = useFormMarketBuy();

    useEffect(() => {
        if (isDirty)
            router.get(
                route("page.buy"),
                { ...queryParams },
                {
                    onBefore: () => setIsLoading(true),
                    onFinish: () => setIsLoading(false),
                    preserveState: true,
                    preserveScroll: true,
                }
            );
    }, [queryParams]);

    return (
        <Layout classNames={{ main: "py-10" }}>
            <section className="w-full flex flex-col max-w-6xl mx-auto">
                <Breadcrumbs>
                    <BreadcrumbItem>
                        <Link href="/">{t("Home")}</Link>
                    </BreadcrumbItem>
                    <BreadcrumbItem>Buy skins</BreadcrumbItem>
                </Breadcrumbs>

                <div className="flex flex-col items-center">
                    <h1 className="text-default-foreground text-4xl uppercase">{t("Buy skins CS2")}</h1>
                    <div className="w-full flex flex-col gap-2">
                        <TopFilters
                            queryParams={queryParams}
                            changeQueryParams={changeQueryParams}
                            checkboxFiltersJson={checkboxFiltersJson}
                        />

                        <div className="grid grid-cols-10 gap-2">
                            <SidebarFilters
                                className="col-span-2"
                                queryParams={queryParams}
                                changeQueryParams={changeQueryParams}
                                checkboxFiltersJson={checkboxFiltersJson}
                            />

                            <div className="col-span-8 flex flex-col gap-2">
                                <Items
                                    formMarketBuy={formMarketBuy}
                                    className="h-[500px]"
                                    marketItems={paginate.data}
                                />

                                <Pagination
                                    queryParams={queryParams}
                                    changeQueryParams={changeQueryParams}
                                    isDisabled={isLoading}
                                    paginate={paginate}
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </Layout>
    );
}
