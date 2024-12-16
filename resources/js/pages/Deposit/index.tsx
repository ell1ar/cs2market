import React, { useEffect, useRef } from "react";
import { router } from "@inertiajs/react";

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
    const intervalId = useRef<NodeJS.Timeout | null>(null);
    useEffect(() => {
        if (intervalId?.current) clearInterval(intervalId.current);
        if (marketDeposit.status !== "proccessing") return;
        intervalId.current = setInterval(() => fetchMarketDeposit(marketDeposit.uuid), 5000);

        return () => {
            clearInterval(intervalId.current!);
        };
    }, [marketDeposit]);

    return <div>index</div>;
}
