import Layout from "@/pages/Layout";
import { useForm } from "@inertiajs/react";
import { Button, Card, CardBody, CardHeader, Input } from "@nextui-org/react";
import { ChangeEvent } from "react";
import { IoLinkSharp } from "react-icons/io5";

type Props = {} & InertiaPageProps;

export default function Index({ auth }: Props) {
    const { data, setData, processing, errors, post } = useForm({
        tradeLink: auth.player?.tradeLink ?? "",
    });

    function submit(e: ChangeEvent<HTMLFormElement>) {
        e.preventDefault();
        post(route("player.info"));
    }

    return (
        <Layout>
            <div className="max-w-6xl w-full mx-auto grid-cols-2 sm:flex py-5 gap-2">
                <Card className="w-full sm:w-72 shrink-0">
                    <CardHeader>{auth.player!.name}</CardHeader>
                    <CardBody>
                        <form
                            onSubmit={submit}
                            className="grow flex flex-col"
                        >
                            <Input
                                onChange={(e) => setData("tradeLink", e.target.value)}
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
                                value={data.tradeLink}
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
