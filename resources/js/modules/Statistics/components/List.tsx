import { cn } from "@/shared/helpers";
import Item from "./Item";

type Props = {
    className?: string;
    statistics: { title: string; value: string }[];
};

export default function List({ className, statistics }: Props) {
    return (
        <div className={cn(className, "flex divide-x-1 divide-default-200")}>
            {statistics.map((item, index) => (
                <Item
                    key={index}
                    title={item.title}
                    value={item.value}
                />
            ))}
        </div>
    );
}
