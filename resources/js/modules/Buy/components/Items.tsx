import Selectable from "@/components/Selectable";
import ItemCard from "@/modules/Market/components/ItemCard";
import { TFormMarketBuy } from "@/modules/Market/types";
import { cn } from "@/shared/helpers";
import { InertiaFormProps } from "@inertiajs/react/types/useForm";
import { Card, CardBody, ScrollShadow } from "@nextui-org/react";

type Props = {
    className?: string;
    marketItems: App.Containers.Market.Data.Resources.MarketItemResource[];
    formMarketBuy: InertiaFormProps<TFormMarketBuy>;
};

export default function Items({ className, marketItems, formMarketBuy }: Props) {
    const onClickSelectItem = (item: App.Containers.Market.Data.Resources.MarketItemResource) => {
        if (formMarketBuy.data.class_instances.includes(item.classInstance))
            return formMarketBuy.setData(
                "class_instances",
                formMarketBuy.data.class_instances.filter((id) => id !== item.classInstance)
            );
        formMarketBuy.setData("class_instances", [...formMarketBuy.data.class_instances, item.classInstance]);
    };

    return (
        <Card className={cn(className)}>
            <CardBody>
                <ScrollShadow>
                    <div className="grid grid-cols-5 gap-2">
                        {marketItems.map((marketItem, index) => (
                            <Selectable
                                isSelected={formMarketBuy.data.class_instances.includes(marketItem.classInstance)}
                                onClickSelectItem={() => onClickSelectItem(marketItem)}
                                key={index}
                            >
                                <ItemCard
                                    className="bg-default-100"
                                    marketItem={marketItem}
                                />
                            </Selectable>
                        ))}
                    </div>
                </ScrollShadow>
            </CardBody>
        </Card>
    );
}
