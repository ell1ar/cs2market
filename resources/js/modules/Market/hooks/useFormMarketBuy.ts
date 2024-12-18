import { useForm } from "@inertiajs/react";
import { TFormMarketBuy } from "../types";

export const useFormMarketBuy = () => {
    const formMarketBuy = useForm<TFormMarketBuy>({
        class_instances: [],
    });

    return formMarketBuy;
};
