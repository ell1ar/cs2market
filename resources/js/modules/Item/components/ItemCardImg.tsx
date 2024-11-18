import { cn } from "@/shared/helpers";
import { HtmlHTMLAttributes, useState } from "react";

type Props = {
    marketHashName: string;
    className?: string;
    skeletonClassName?: string;
} & HtmlHTMLAttributes<HTMLImageElement>;

export default function ItemCardImg({ marketHashName, className, skeletonClassName, ...props }: Props) {
    const [loaded, setLoaded] = useState(false);
    const onLoadImg = () => setLoaded(true);
    const onErrorImg = () => setLoaded(false);

    return (
        <>
            <img
                className={cn(className, `w-2/3 grayscale-[15%]`)}
                style={{ display: loaded ? "block" : "none" }}
                onLoad={onLoadImg}
                onError={onErrorImg}
                src={`https://cdn2.csgo.com/item/image/width=300/${marketHashName}.webp`}
                alt={marketHashName}
                {...props}
            />

            {!loaded && <div className={`skeleton-box h-1/2 w-2/3 ${skeletonClassName}`} />}
        </>
    );
}
