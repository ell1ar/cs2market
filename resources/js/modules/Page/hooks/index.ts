import { useForm } from "@inertiajs/react";
import { TFormPageSell } from "../types";

export const useFormPageSell = (params: any) => {
    const formPageSell = useForm<TFormPageSell>({
        trade_link: params.trade_link ?? "",
        name: params.name ?? "",
        sort_by: "price",
        sort_dir: "desc",
    });

    return formPageSell;
};
