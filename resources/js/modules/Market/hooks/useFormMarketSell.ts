import { useForm } from "@inertiajs/react";
import { TFormMarketSell } from "../types";

export const useFormMarketSell = () => {
    const formMarketSell = useForm<TFormMarketSell>({
        instance_ids: [],
    });

    return formMarketSell;
};
