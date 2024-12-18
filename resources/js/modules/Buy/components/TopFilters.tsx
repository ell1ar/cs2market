import CurrencySelect from "@/modules/Currency/components/Select";
import { TChangeQueryParamsFn, TQueryParams } from "@/modules/Filter/hooks/useQueryFilter";
import { cn } from "@/shared/helpers";
import { Image, Select, SelectItem } from "@nextui-org/react";
import { ChangeEvent } from "react";

type Props = {
    className?: string;
    queryParams: TQueryParams;
    changeQueryParams: TChangeQueryParamsFn;
    checkboxFiltersJson?: Record<string, any>;
};

export default function TopFilters({ className, checkboxFiltersJson, queryParams, changeQueryParams }: Props) {
    const onChange = (e: ChangeEvent<HTMLSelectElement>) =>
        changeQueryParams(
            {
                key: "weapons",
                value: e.target.value,
            },
            {
                isMultiple: true,
            }
        );

    return (
        <header className={cn(className, "grid grid-cols-11 gap-2 w-full")}>
            {checkboxFiltersJson?.weapons.map((weapon: any) => (
                <Select
                    key={weapon.key}
                    size="sm"
                    label={weapon.title}
                    selectionMode="multiple"
                    selectedKeys={queryParams?.weapons?.$contains?.split(",") ?? []}
                    onChange={onChange}
                    classNames={{
                        popoverContent: "w-80",
                        value: "text-sm",
                    }}
                >
                    {weapon.list.map((option: any) => (
                        <SelectItem
                            key={option.key}
                            className="text-foreground"
                            startContent={
                                <Image
                                    width={"44rem"}
                                    src={option.img}
                                />
                            }
                        >
                            {option.title}
                        </SelectItem>
                    ))}
                </Select>
            ))}
        </header>
    );
}
