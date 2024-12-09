import Selectable from "@/components/Selectable";
import ItemCard from "@/modules/Market/components/ItemCard";
import { cn } from "@/shared/helpers";
import { Card, CardBody, ScrollShadow } from "@nextui-org/react";

type Props = {
    className?: string;
    marketItems: App.Containers.Market.Data.Resources.MarketItemResource[];
};

export default function Items({ className, marketItems }: Props) {
    return (
        <Card className={cn(className)}>
            <CardBody>
                <ScrollShadow>
                    <div className="grid grid-cols-5 gap-2">
                        {marketItems.map((marketItem, index) => (
                            <Selectable
                                isSelected={false}
                                onClickSelectItem={() => {}}
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
