import ItemCard from "@/modules/Item/components/ItemCard";
import ILiveDrop from "@/modules/LiveDrop/types";
import { cn } from "@/shared/helpers";

type Props = {
    className?: string;
    liveDrop: ILiveDrop;
};

export default function LiveDropItem({ className, liveDrop }: Props) {
    return (
        <div className={cn(className, "group h-20 shrink-0 -translate-y-full transition-all duration-300 hover:translate-y-0")}>
            <div className="p-3 relative flex h-full w-full flex-col items-start justify-end overflow-hidden rounded-[2px] bg-content1">
                <img
                    className="z-10 h-auto w-1/4 rounded-[2px] object-contain"
                    src={liveDrop.player.image}
                    alt="player image"
                />
                <p className="z-10 w-2/3 truncate text-start text-xs text-white/80">{liveDrop.player.name}</p>
            </div>

            <ItemCard
                className="animate__animated animate__fadeInUp animate__fast h-full w-full rounded"
                isShowPrice={false}
                isShowBottomName={false}
                item={liveDrop.item}
            />
        </div>
    );
}
