import ItemCard from "@/modules/Item/components/ItemCard";
import CardBadge from "@/modules/PlayerItem/components/CardBadge";
import { IPlayerItem, PlayerItemStatus } from "@/modules/PlayerItem/types";
import { cn } from "@/shared/helpers";
import LinkButton from "@/shared/ui/LinkButton";
import { Button } from "@nextui-org/react";
import { FaHandHoldingDollar, FaSteam } from "react-icons/fa6";
import { toast } from "react-toastify";

type Props = {
    className?: string;
    playerItem: IPlayerItem;
};

export default function PlayerItemCard({ className, playerItem }: Props) {
    return (
        <div
            key={playerItem.id}
            className={cn(className, "relative w-full overflow-hidden rounded-2xl transition-all duration-300")}
        >
            <div className="absolute right-2 bottom-2 z-30 flex w-fit flex-col justify-center gap-0.5">
                {playerItem.status === PlayerItemStatus.READY ? (
                    <>
                        <Button
                            size="sm"
                            color="success"
                            as={LinkButton}
                            href={route("player-item.sell", { uniqid: playerItem.uniqid })}
                            method="post"
                            preserveScroll
                            onError={(errors) => {
                                toast.error(Object.values(errors)[0]);
                            }}
                        >
                            <FaHandHoldingDollar />
                            <span>Sell</span>
                        </Button>

                        <Button
                            size="sm"
                            color="primary"
                            as={LinkButton}
                            href={route("player-item.trade", { uniqid: playerItem.uniqid })}
                            method="post"
                            preserveScroll
                            onError={(errors) => {
                                toast.error(Object.values(errors)[0]);
                            }}
                        >
                            <FaSteam />
                            <span>Trade</span>
                        </Button>
                    </>
                ) : (
                    <CardBadge status={playerItem.status} />
                )}
            </div>

            <ItemCard
                className="h-full w-full"
                item={playerItem}
            />
        </div>
    );
}
