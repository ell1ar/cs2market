import Layout from "@/pages/Layout";
import { router, useForm } from "@inertiajs/react";
import { Button, Card, CardBody, CardHeader, Input } from "@nextui-org/react";
import { ChangeEvent, useEffect, useState } from "react";
import { IoLinkSharp } from "react-icons/io5";

type Props = {} & InertiaPageProps;

export default function Index({ auth }: Props) {
    const [isLoading, setIsLoading] = useState(false);
    const { setData, processing, errors, post, clearErrors } = useForm({
        tradeLink: auth.player!.trade_link,
    });

    function submit(e: ChangeEvent<HTMLFormElement>) {
        e.preventDefault();
        post(route("player.info"));
    }

    useEffect(() => {
        router.on("start", () => setIsLoading(true));
        router.on("finish", () => setIsLoading(false));
    }, []);

    return (
        <Layout>
            <div className="grid-cols-2 sm:flex py-5 gap-2">
                <Card className="w-full sm:w-72 shrink-0">
                    <CardHeader>{auth.player!.name}</CardHeader>
                    <CardBody>
                        <form
                            onSubmit={submit}
                            className="grow flex flex-col"
                        >
                            <Input
                                onChange={(e) => {
                                    setData("tradeLink", e.target.value);
                                    clearErrors("tradeLink");
                                }}
                                defaultValue={auth.player!.trade_link}
                                size="sm"
                                label="Trade URL"
                                description={
                                    <p className="flex justify-between">
                                        <span className="inline-flex gap-0.5 items-center text-sm font-bold uppercase">
                                            <IoLinkSharp className="text-xl" />
                                            <span>Trade URL</span>
                                        </span>

                                        <Button
                                            size="sm"
                                            as={"a"}
                                            href="http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url"
                                            target="_blank"
                                        >
                                            Where to get?
                                        </Button>
                                    </p>
                                }
                                isInvalid={!!errors?.tradeLink}
                                errorMessage={errors?.tradeLink}
                            />

                            <Button
                                type="submit"
                                className="mt-auto"
                                color="primary"
                                isDisabled={processing}
                            >
                                Update
                            </Button>
                        </form>
                    </CardBody>
                </Card>
            </div>
        </Layout>
    );
}
