import ItemCardImg from "@/modules/Item/components/ItemCardImg";
import { ItemRarity } from "@/modules/Item/constants/rarityColors";
import useItemName from "@/modules/Item/hooks/useItemName";
import { IItem } from "@/modules/Item/types";
import { cn } from "@/shared/helpers";

export type Props = {
    item: IItem;
    className?: string;
    skeletonClassName?: string;
    isShowPrice?: boolean;
    isShowQaulity?: boolean;
    isShowName?: boolean;
    isShowBottomName?: boolean;
};

export default function ItemCard({ className, isShowPrice = true, isShowQaulity = true, isShowName = true, isShowBottomName = true, item, skeletonClassName, ...props }: Props) {
    const { topName, bottomName } = useItemName(item.marketHashName);

    return (
        <div
            className={cn(className, "group relative flex h-36 w-52 overflow-hidden rounded-2xl bg-content1 items-center justify-center p-2")}
            style={{
                background: `linear-gradient(135deg, ${ItemRarity[item.rarity as keyof typeof ItemRarity]}40 0%, hsl(var(--nextui-content1)) 100%)`,
            }}
            {...props}
        >
            <ItemCardImg
                className="relative z-10 transition-all duration-500 ease-in-out group-hover:translate-y-1"
                skeletonClassName={skeletonClassName}
                marketHashName={item.marketHashName}
            />

            {isShowPrice && <span className="absolute right-2 top-2 text-center text-xs font-bold text-success">{item.price}$</span>}
            {isShowQaulity && <span className="absolute left-2 top-5 text-xs text-text-secondary">{item.quality}</span>}
            {isShowName && (
                <div className="absolute bottom-2 left-2 z-10 flex w-full flex-col -space-y-1 text-left">
                    <span className="max-w-[80%] truncate whitespace-nowrap text-xs text-white">{topName}</span>
                    {isShowBottomName && <span className="max-w-[80%] truncate whitespace-nowrap text-[9px] text-white/70">{bottomName}</span>}
                </div>
            )}

            <div
                className="h-2 w-2 rounded-full absolute left-2 top-2"
                style={{
                    background: `${ItemRarity[item.rarity as keyof typeof ItemRarity]}`,
                }}
            ></div>
        </div>
    );
}
