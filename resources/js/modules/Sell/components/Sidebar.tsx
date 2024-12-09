import CurrencySelect from "@/modules/Currency/components/Select";
import { cn } from "@/shared/helpers";
import { Button, Card, CardBody, Divider } from "@nextui-org/react";

type Props = {
    className?: string;
};

export default function Sidebar({ className }: Props) {
    return (
        <Card className={cn(className, "flex flex-col gap-2")}>
            <CardBody>
                <div className="flex text-foreground items-center gap-2 justify-between">
                    <p>
                        Selected <strong className="text-secondary-600">0</strong> items for the amount
                    </p>
                    <Divider orientation="vertical" />
                    <CurrencySelect />
                </div>

                <Button className="mt-auto" color="secondary">Sell</Button>
            </CardBody>
        </Card>
    );
}
