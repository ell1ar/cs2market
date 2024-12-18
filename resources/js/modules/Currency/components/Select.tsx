import usePage from "@/shared/hooks/usePage";
import { router } from "@inertiajs/react";
import { Select as BaseSelect, SelectItem } from "@nextui-org/react";
import { ChangeEvent } from "react";

type Props = {};

export default function Select({}: Props) {
    const { props } = usePage();

    const onChange = (e: ChangeEvent<HTMLSelectElement>) => {
        router.post(route("currency.set", { currency: e.target.value }));
    };

    return (
        <BaseSelect
            defaultSelectedKeys={[props.currency.current]}
            classNames={{
                base: "w-20",
            }}
            aria-labelledby="basic"
            size="sm"
            onChange={onChange}
        >
            {props.currency.avaiableList.map((currency) => (
                <SelectItem
                    className="text-white"
                    key={currency}
                >
                    {currency}
                </SelectItem>
            ))}
        </BaseSelect>
    );
}
