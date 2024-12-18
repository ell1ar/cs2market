import { cn } from "@/shared/helpers";
import usePage from "@/shared/hooks/usePage";
import getSymbolFromCurrency from "currency-symbol-map";

type Props = {
    className?: string;
    value: number;
};

export default function Currency({ className, value }: Props) {
    const { props } = usePage();

    return (
        <span className={cn(className, "inline-flex items-center gap-0.5")}>
            <span>{getSymbolFromCurrency(props.currency.current)}</span>
            <span>{value}</span>
        </span>
    );
}
