import { PlayerItemStatus } from "@/modules/PlayerItem/types";
import { Tooltip } from "@nextui-org/react";
import { FaWallet } from "react-icons/fa";
import { FaSteam } from "react-icons/fa6";

type Props = {
    status: PlayerItemStatus;
};

export default function CardBadge({ status }: Props) {
    const info = {
        [PlayerItemStatus.READY]: null,
        [PlayerItemStatus.TRADE_WAIT]: {
            content: "Trade wait",
            icon: <FaSteam />,
        },
        [PlayerItemStatus.TRADE_PROCESS]: {
            content: "Trade process",
            icon: <FaSteam />,
        },
        [PlayerItemStatus.SELL]: {
            content: "Sold",
            icon: <FaWallet />,
        },
        [PlayerItemStatus.TRADED]: {
            content: "Traded",
            icon: <FaSteam />,
        },
    }[status];

    return (
        <div className={`bg-contant-1 flex h-7 w-7 items-center justify-center gap-2 rounded-[2px] p-1 text-sm font-bold`}>
            {info !== null && (
                <Tooltip
                    color="primary"
                    content={<span className="text-white">{info.content}</span>}
                >
                    <span>{info.icon}</span>
                </Tooltip>
            )}
        </div>
    );
}
