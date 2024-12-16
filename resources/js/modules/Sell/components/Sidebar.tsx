import CurrencySelect from "@/modules/Currency/components/Select";
import { TFormMarketSell } from "@/modules/Market/types";
import { Props } from "@/pages/Sell";
import { cn, roundLikePHP } from "@/shared/helpers";
import { usePage } from "@inertiajs/react";
import { InertiaFormProps } from "@inertiajs/react/types/useForm";
import { Button, Card, CardBody, Divider } from "@nextui-org/react";
import { useTranslation } from "react-i18next";

export default function Sidebar({ className, formMarketSell }: { className?: string; formMarketSell: InertiaFormProps<TFormMarketSell> }) {
    const { t } = useTranslation();
    const { inventoryItems, auth } = usePage<Props>().props;
    const price = roundLikePHP(
        formMarketSell.data.instance_ids.reduce((acc, id) => acc + (inventoryItems.find((item) => item.instanceId === id)?.price ?? 0), 0),
        2
    );

    function submit(e: any) {
        e.preventDefault();
        formMarketSell.post(route("page.sell"), {
            preserveScroll: true,
            preserveState: true,
        });
    }

    return (
        <Card
            as={"form"}
            onSubmit={submit}
            className={cn(className, "flex flex-col gap-2")}
        >
            <CardBody>
                <div className="flex text-foreground items-center gap-2 justify-between">
                    <p>
                        Selected <strong className="text-secondary-600">{price}</strong> items for the amount
                    </p>
                    <Divider orientation="vertical" />
                    <CurrencySelect />
                </div>

                {auth.player ? (
                    <Button
                        type="submit"
                        isDisabled={formMarketSell.data.instance_ids.length === 0 || formMarketSell.processing}
                        className="mt-auto"
                        color="secondary"
                    >
                        Sell
                    </Button>
                ) : (
                    <Button
                        color="default"
                        className="mt-auto"
                    >
                        You need to be logged in to sell items
                    </Button>
                )}
            </CardBody>
        </Card>
    );
}
