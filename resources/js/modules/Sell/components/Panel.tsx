import Selectable from "@/components/Selectable";
import { Props } from "@/pages/Sell";
import { cn } from "@/shared/helpers";
import usePage from "@/shared/hooks/usePage";
import { useForm } from "@inertiajs/react";
import { Card, CardBody, Input } from "@nextui-org/react";
import { ScrollShadow } from "@nextui-org/scroll-shadow";
import { useEffect } from "react";

export default function Panel({ className }: { className?: string }) {
    const { ziggy, inventoryItems } = usePage<Props>().props;

    const { data, setData, errors, processing, get, isDirty } = useForm({
        trade_link: ziggy.query.trade_link ?? "",
        name: ziggy.query.name ?? "",
        sort_by: "price",
        sort_dir: "desc",
    });

    useEffect(() => {
        if (isDirty)
            get(route("page.sell"), {
                preserveState: true,
            });
    }, [data]);

    return (
        <div className={cn(className, "flex flex-col gap-2")}>
            {/* Trade link */}
            <Card>
                <CardBody className="gap-2">
                    <label htmlFor="">
                        Insert your{" "}
                        <a
                            className="text-secondary-600"
                            href="https://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url"
                            target="_blank"
                        >
                            Trade Link
                        </a>
                    </label>

                    <Input
                        isInvalid={!!errors.trade_link}
                        errorMessage={errors.trade_link}
                        placeholder="https://steamcommunity.com/tradeoffer/new/?partner=...."
                        onChange={(e) => setData("trade_link", e.target.value)}
                        value={data.trade_link}
                    />
                </CardBody>
            </Card>

            {/* FIlters */}
            <Card>
                <CardBody>
                    <Input
                        placeholder="Search skins"
                        onChange={(e) => setData("name", e.target.value)}
                        value={data.name}
                    />
                </CardBody>
            </Card>

            {/* Items */}
            <Card>
                <CardBody>
                    <ScrollShadow className="h-[400px]">
                        <div className="grid grid-cols-4 gap-2">
                            {inventoryItems &&
                                inventoryItems.map((item, index) => (
                                    <Selectable
                                        isSelected={false}
                                        onClickSelectItem={() => {}}
                                        key={index}
                                        className={cn(!item.tradable && "opacity-50 cursor-not-allowed", "flex flex-col relative w-full h-44 rounded-xl bg-default-100")}
                                    >
                                        <img
                                            className="absolute w-full h-full object-contain object-center z-0"
                                            src={`https://community.akamai.steamstatic.com/economy/image/${item.icon}`}
                                            alt={item.name}
                                        />

                                        <div className="flex flex-col truncate items-start mt-auto p-2 relative z-10">
                                            <span className="text-xs font-bold">{item.name}</span>
                                            <span className="text-success font-bold text-sm">${item.price}</span>
                                        </div>
                                    </Selectable>
                                ))}
                        </div>
                    </ScrollShadow>
                </CardBody>
            </Card>
        </div>
    );
}
