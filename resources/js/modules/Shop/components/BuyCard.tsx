import { InertiaPageProps } from "@/shared/types/custom";
import { useForm, usePage } from "@inertiajs/react";
import { Button, Card, CardBody, Input } from "@nextui-org/react";
import { ChangeEvent } from "react";
import { FaDollarSign } from "react-icons/fa";

type Props = {};

export default function BuyCard({}: Props) {
    const { props } = usePage<InertiaPageProps>();

    const { setData, processing, errors, post, data } = useForm({
        price: props.auth.player?.balance ?? 0,
    });

    function submit(e: ChangeEvent<HTMLFormElement>) {
        e.preventDefault();
        post(route("shop.buy"));
    }

    return (
        <Card>
            <CardBody className="">
                <form
                    onSubmit={submit}
                    className="flex flex-col justify-center grow gap-2"
                >
                    <Input
                        startContent={<FaDollarSign className="text-success" />}
                        placeholder="Price"
                        onChange={(e) => setData("price", Number(e.target.value))}
                        type="number"
                        step={"0.01"}
                        value={data.price.toString()}
                        errorMessage={errors.price}
                        isInvalid={!!errors.price}
                    />
                    <Button
                        fullWidth
                        isDisabled={processing}
                        type="submit"
                        variant="solid"
                    >
                        Buy
                    </Button>
                </form>
            </CardBody>
        </Card>
    );
}
