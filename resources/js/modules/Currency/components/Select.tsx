import usePage from "@/shared/hooks/usePage";
import { Select as BaseSelect, SelectItem } from "@nextui-org/react";
import React, { ChangeEvent } from "react";

type Props = {};

export default function Select({}: Props) {
    const { props } = usePage();

    const onChange = (e: ChangeEvent<HTMLSelectElement>) => {
        console.log(e.target.value);
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