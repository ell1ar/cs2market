import { cn } from "@/shared/helpers";
import { Image } from "@nextui-org/react";
import React from "react";

type Props = {
    className?: string;
    marketItem: App.Containers.Market.Data.Resources.MarketItemResource;
};

export default function ItemImage({ className, marketItem }: Props) {
    let src;

    if (!!marketItem.icon) {
        src = `https://community.akamai.steamstatic.com/economy/image/${marketItem.icon}`;
    } else {
        src = `https://cdn2.csgo.com/item/image/width=300/${marketItem.name}.webp`;
    }

    return (
        <Image
            className={cn(className)}
            src={src}
            width={150}
        />
    );
}
