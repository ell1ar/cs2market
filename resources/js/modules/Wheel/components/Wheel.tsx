import ItemCardImg from "@/modules/Item/components/ItemCardImg";
import { ItemRarity } from "@/modules/Item/constants/rarityColors";
import { IItem } from "@/modules/Item/types";
import { IPlayerItem } from "@/modules/PlayerItem/types";
import { cn } from "@/shared/helpers";
import { useEffect, useLayoutEffect, useState } from "react";
import { BiSolidDownArrow } from "react-icons/bi";
import { ANIMATION_TRANSITION_MS } from "../constants";
import { TWheelInfo } from "../types";

type Props = {
    wheelInfo: TWheelInfo;
    className?: string;
};

export default function Wheel({ wheelInfo, className }: Props) {
    const [rotateDeg, setRotateDeg] = useState(0);
    const [width, setWidth] = useState(300);

    useLayoutEffect(() => {
        window.innerWidth < 1024 ? setWidth(300) : setWidth(450);
    }, []);

    useEffect(() => {
        if (wheelInfo.winPlayerItem === null) return;
        if (wheelInfo.isAnimating) setRotateDeg((prev) => prev + 3600);
    }, [wheelInfo]);

    const getCoordinates = (index: number) => {
        const countWheelPrizes = wheelInfo.items.length;
        const circleRadius = width / 2.7;
        const rad = ((((countWheelPrizes - index) * 360) / countWheelPrizes) * Math.PI) / 180;
        const x = Math.cos(rad) * circleRadius;
        const y = Math.sin(rad) * circleRadius;
        const deg = -rad * (180 / Math.PI) - 120;
        return { x, y, deg, itemId: wheelInfo.items[index].id };
    };

    return (
        <div className={cn(className, "flex justify-center")}>
            <span className="absolute -top-4 text-yellow-400 text-4xl z-10">
                <BiSolidDownArrow />
            </span>

            <div
                className={cn("relative z-0 flex aspect-square shrink-0 bg-default-100 rounded-full items-center justify-center")}
                style={{ transform: `rotate(${rotateDeg}deg)`, transition: `transform ${ANIMATION_TRANSITION_MS}ms ease-out`, width: `${width}px` }}
            >
                <div className="absolute flex h-full w-full items-center justify-center">
                    {wheelInfo.items.map((item, index) => (
                        <CellItem
                            key={index}
                            item={wheelInfo.winPlayerItem && index === 3 ? wheelInfo.winPlayerItem : item}
                            coordinates={getCoordinates(index)}
                            rotateDeg={rotateDeg}
                        />
                    ))}
                </div>

                <div className="aspect-square w-56 bg-content1 rounded-full"></div>
            </div>
        </div>
    );
}

function CellItem({ item, coordinates, rotateDeg }: { item: IPlayerItem | IItem; coordinates: { x: number; y: number; deg: number; itemId: number }; rotateDeg: number }) {
    return (
        <div
            className={`absolute tranition-all w-[18%] duration-300 bg-default-100 rounded-full aspect-square flex items-center justify-center border-2`}
            style={{
                transform: `translateX(${coordinates.x}px) translateY(${coordinates.y}px)`,
                borderColor: `${ItemRarity[item.rarity as keyof typeof ItemRarity]}`,
                background: `linear-gradient(180deg, ${ItemRarity[item.rarity as keyof typeof ItemRarity]}20 0%, hsl(var(--nextui-content1)) 100%)`,
            }}
        >
            <ItemCardImg
                className="w-16"
                marketHashName={item.marketHashName}
                style={{ transform: `rotate(-${rotateDeg}deg)`, transition: `transform ${ANIMATION_TRANSITION_MS}ms ease-out` }}
            />
        </div>
    );
}
