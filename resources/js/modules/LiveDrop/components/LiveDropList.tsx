import LiveDropItem from "@/modules/LiveDrop/components/LiveDropItem";
import { CHANNEL, LIMIT_COUNT_DROPS } from "@/modules/LiveDrop/constants";
import ILiveDrop from "@/modules/LiveDrop/types";
import { cn } from "@/shared/helpers";
import centrifuge from "@/shared/libs/centrifugo";
import _ from "lodash";
import { useEffect, useState } from "react";
import SkeletonLiveDropItem from "./SkeletonLiveDropItem";

type Props = {
    className?: string;
};

export default function LiveDropList({ className }: Props) {
    const [isSubscribed, setIsSubscribed] = useState(false);
    const [liveDrops, setLiveDrops] = useState<ILiveDrop[]>([]);

    const loadHistory = async (wsChannel: any) => {
        const resp = await wsChannel.history({ limit: LIMIT_COUNT_DROPS, reverse: true });
        setIsSubscribed(true);
        setLiveDrops(resp.publications.map((publication: any) => ({ ...publication.data.live_drop, uid: _.uniqueId("liveDrop_") })));
    };

    useEffect(() => {
        if (typeof window !== "undefined") {
            let wsChannel = centrifuge.getSub(CHANNEL);

            if (wsChannel) {
                loadHistory(wsChannel);
            }

            if (!wsChannel) {
                wsChannel = centrifuge.subscribe(CHANNEL);
                wsChannel.on("subscribe", loadHistory.bind(null, wsChannel));
            }

            wsChannel.on("publish", async ({ data }: any) => {
                setLiveDrops((prev) => {
                    if (prev.length >= LIMIT_COUNT_DROPS) prev = prev.slice(0, -1);
                    return [{ ...data.live_drop, uid: _.uniqueId("liveDrop_") }, ...prev];
                });
            });
        }
    }, []);

    return (
        <div className={cn(className, "relative flex h-[88px] gap-1 rounded-[2px] bg-content1/50 p-1")}>
            {isSubscribed ? (
                <div className="flex-flex-nowrap flex h-full grow gap-1 overflow-hidden rounded-[2px] bg-content-3 xl:grid xl:grid-cols-12 xl:place-content-center">
                    {liveDrops.map((liveDrop) => (
                        <LiveDropItem
                            key={liveDrop.uid}
                            liveDrop={liveDrop}
                            className="w-28 xl:w-full"
                        />
                    ))}
                </div>
            ) : (
                <div className="flex-flex-nowrap flex h-full grow gap-1 overflow-hidden rounded-[2px] bg-content-2 xl:grid xl:grid-cols-12 xl:place-content-center">
                    {Array.from({ length: LIMIT_COUNT_DROPS }).map((_, i) => (
                        <SkeletonLiveDropItem
                            key={i}
                            className="w-28 xl:w-full"
                        />
                    ))}
                </div>
            )}
        </div>
    );
}
