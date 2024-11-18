import SkeletonItemCard from "@/modules/Item/components/SkeletonItemCard";
import { cn } from "@/shared/helpers";
import React from "react";

type Props = {
    className?: string;
};

export default function SkeletonLiveDropItem({ className }: Props) {
    return (
        <SkeletonItemCard
            className={cn(className, "h-20 shrink-0")}
            isShowPrice={false}
            isShowBottomName={false}
        />
    );
}
