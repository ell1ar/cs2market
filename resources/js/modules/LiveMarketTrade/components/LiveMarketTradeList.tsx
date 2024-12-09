import MarketItemCard from "@/modules/Market/components/ItemCard";
import { cn } from "@/shared/helpers";
import centrifuge from "@/shared/lib/centrifugo";
import _ from "lodash";
import { useEffect, useState } from "react";
import { CHANNEL, LIMIT_COUNT_DROPS } from "../constants";

type Props = {
    className?: string;
};

export default function LiveMarketTradeList({ className }: Props) {
    const [isSubscribed, setIsSubscribed] = useState(false);
    const [liveMarketTrades, setLiveMarketTrades] = useState<UUID<App.Containers.Market.Data.Resources.LiveMarketTradeResource>[]>([]);

    const loadHistory = async (wsChannel: any) => {
        const resp = await wsChannel.history({ limit: LIMIT_COUNT_DROPS, reverse: true });
        setIsSubscribed(true);
        setLiveMarketTrades(resp.publications.map((publication: any) => ({ ...publication.data.liveMarketTrade, uuid: _.uniqueId("liveMarketTrade_") })));
    };

    useEffect(() => {
        if (typeof window !== "undefined") {
            let wsChannel = centrifuge.getSub(CHANNEL);
            console.log(wsChannel);
            
            if (wsChannel) {
                loadHistory(wsChannel);
            }

            if (!wsChannel) {
                wsChannel = centrifuge.subscribe(CHANNEL);
                wsChannel.on("subscribe", loadHistory.bind(null, wsChannel));
            }

            wsChannel.on("publish", async ({ data }: any) => {
                setLiveMarketTrades((prev) => {
                    if (prev.length >= LIMIT_COUNT_DROPS) prev = prev.slice(0, -1);
                    return [{ ...data.liveMarketTrade, uid: _.uniqueId("liveMarketTrade_") }, ...prev];
                });
            });
        }
    }, []);

    return (
        <div className={cn(className, "relative flex h-52 gap-1 bg-content1/50 p-1 rounded-xl")}>
            {isSubscribed && (
                <div className="flex-flex-nowrap flex h-52 gap-1 overflow-hidden xl:grid xl:grid-cols-7 xl:place-content-center">
                    {liveMarketTrades.map((liveMarketTrade) => (
                        <MarketItemCard
                            className="!h-52 animate-fade-right animate-once animate-delay-0 animate-ease-in"
                            key={liveMarketTrade.uuid}
                            marketItem={liveMarketTrade.marketItem}
                        />
                    ))}
                </div>
            )}
        </div>
    );
}
