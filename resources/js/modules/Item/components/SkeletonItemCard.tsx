import { cn } from "@/shared/helpers";

type Props = {
    className?: string;
    isShowPrice?: boolean;
    isShowName?: boolean;
    isShowBottomName?: boolean;
};

export default function SkeletonItemCard({ className, isShowPrice = true, isShowName = true, isShowBottomName = true }: Props) {
    return (
        <div className={cn(className, "group relative flex h-36 w-52 items-center justify-center overflow-hidden rounded-sm bg-content1")}>
            <div className="flex h-full w-full items-center justify-center p-2">
                <div className="relative z-10 transition-all duration-500 ease-in-out group-hover:translate-y-1" />
                {isShowPrice && <div className="skeleton-box absolute right-2 top-2 h-5 w-12" />}
                {isShowName && (
                    <div className="absolute bottom-2 left-2 z-10 flex w-full flex-col gap-1 text-left">
                        <div className="skeleton-box h-3.5 w-[50%]" />
                        {isShowBottomName && <div className="skeleton h-3 w-[80%]" />}
                    </div>
                )}
                <div className="absolute bottom-0.5 h-0.5 w-1/3 rounded-[2px] bg-content-3" />
            </div>
        </div>
    );
}
