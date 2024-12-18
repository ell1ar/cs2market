import { cn } from "@/shared/helpers";
import { Card } from "@nextui-org/react";
import ItemImage from "./ItemImage";
import Currency from "@/modules/Currency/components/Currency";

type Props = {
    className?: string;
    marketItem: App.Containers.Market.Data.Resources.MarketItemResource;
};

export default function ItemCard({ className, marketItem }: Props) {
    return (
        <Card className={cn(className, "flex flex-col items-center justify-center relative w-full h-40 rounded-xl")}>
            <div className="absolute w-2/3 z-0 mb-5">
                <ItemImage marketItem={marketItem} />
            </div>

            <div className="flex flex-col text-start mt-auto p-2 w-full relative z-10">
                <span className="text-xs font-bold truncate w-5/6">{marketItem.name}</span>

                <Currency
                    className="text-success font-bold text-sm"
                    value={marketItem.price}
                />
            </div>
        </Card>
    );
}
