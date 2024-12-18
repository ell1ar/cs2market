import Selectable from "@/components/Selectable";
import Currency from "@/modules/Currency/components/Currency";
import { TFormMarketSell } from "@/modules/Market/types";
import { TFormPageSell } from "@/modules/Page/types";
import { Props } from "@/pages/Sell";
import { cn } from "@/shared/helpers";
import usePage from "@/shared/hooks/usePage";
import { InertiaFormProps } from "@inertiajs/react/types/useForm";
import { Button, Card, CardBody, Input } from "@nextui-org/react";
import { ScrollShadow } from "@nextui-org/scroll-shadow";
import { useTranslation } from "react-i18next";
import { GrUpdate } from "react-icons/gr";

export default function Panel({
    className,
    formMarketSell,
    formPageSell,
}: {
    className?: string;
    formMarketSell: InertiaFormProps<TFormMarketSell>;
    formPageSell: InertiaFormProps<TFormPageSell>;
}) {
    const { t } = useTranslation();
    const { inventoryItems, auth } = usePage<Props>().props;

    const onClickSelectItem = (item: App.Containers.Market.Data.Resources.InventoryItemResource) => {
        if (formMarketSell.data.instance_ids.includes(item.instanceId))
            return formMarketSell.setData(
                "instance_ids",
                formMarketSell.data.instance_ids.filter((id) => id !== item.instanceId)
            );
        formMarketSell.setData("instance_ids", [...formMarketSell.data.instance_ids, item.instanceId]);
    };

    return (
        <div className={cn(className, "flex flex-col gap-2")}>
            {auth.player ? (
                <>
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
                                isDisabled={formPageSell.processing}
                                isInvalid={!!formPageSell.errors.trade_link}
                                errorMessage={formPageSell.errors.trade_link}
                                placeholder="https://steamcommunity.com/tradeoffer/new/?partner=...."
                                onChange={(e) => formPageSell.setData("trade_link", e.target.value)}
                                value={formPageSell.data.trade_link}
                            />
                        </CardBody>
                    </Card>

                    {/* FIlters */}
                    <Card>
                        <CardBody className="flex gap-2 items-center flex-row">
                            <Input
                                isDisabled={formPageSell.processing}
                                placeholder="Search skins"
                                onChange={(e) => formPageSell.setData("name", e.target.value)}
                                value={formPageSell.data.name}
                            />

                            <Button
                                className="h-10 !px-0 min-w-0 w-10"
                                isDisabled={formPageSell.processing}
                                onPress={() => formPageSell.get(route("page.sell"), { preserveState: true })}
                            >
                                <GrUpdate className={cn(formPageSell.processing && "animate-spin")} />
                            </Button>
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
                                                isSelected={formMarketSell.data.instance_ids.includes(item.instanceId)}
                                                onClickSelectItem={() => onClickSelectItem(item)}
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
                                                    <Currency
                                                        className="text-success font-bold text-sm"
                                                        value={item.price}
                                                    />
                                                </div>
                                            </Selectable>
                                        ))}
                                </div>
                            </ScrollShadow>
                        </CardBody>
                    </Card>
                </>
            ) : (
                <Card className="h-80">
                    <CardBody className="items-center justify-center">{t("Authentication required")}</CardBody>
                </Card>
            )}
        </div>
    );
}
