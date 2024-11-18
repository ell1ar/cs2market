import SkeletonLiveDropItem from "@/modules/LiveDrop/components/SkeletonLiveDropItem";
import { LIMIT_COUNT_DROPS } from "@/modules/LiveDrop/constants";

type Props = {};

export default function SkeletonLiveDropList({}: Props) {
    return (
        <div className="flex-flex-nowrap flex h-full grow gap-1 overflow-hidden rounded-[2px] bg-content-3 xl:grid xl:grid-cols-12 xl:place-content-center">
            {Array.from({ length: LIMIT_COUNT_DROPS }).map((_, i) => (
                <SkeletonLiveDropItem
                    key={i}
                    className="w-28 xl:w-full"
                />
            ))}
        </div>
    );
}
