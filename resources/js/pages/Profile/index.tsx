import Pagination from "@/components/Pagination";
import PlayerItemCard from "@/modules/PlayerItem/components/Card";
import { IPlayerItem } from "@/modules/PlayerItem/types";
import BuyCard from "@/modules/Shop/components/BuyCard";
import Layout from "@/pages/Layout";
import { cn } from "@/shared/helpers";
import { InertiaPageProps } from "@/shared/types/custom";
import { router, useForm } from "@inertiajs/react";
import { Button, Card, CardBody, CardFooter, CardHeader, Input } from "@nextui-org/react";
import { ChangeEvent, useEffect, useState } from "react";
import { FaGun } from "react-icons/fa6";
import { IoLinkSharp } from "react-icons/io5";

type Props = {
    paginate: {
        data: IPlayerItem[];
        links: Record<string, string>;
        meta: Record<string, string>;
    };
} & InertiaPageProps;

export default function Index({ auth, paginate }: Props) {
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

                <Card className={cn("flex flex-col w-full")}>
                    <CardHeader className="gap-2">
                        <FaGun />
                        <span>Inventory</span>
                    </CardHeader>
                    <CardBody>
                        <div className="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-0.5 w-full">
                            {paginate.data.map((playerItem: IPlayerItem, index: number) => (
                                <PlayerItemCard
                                    className="h-28 sm:h-32"
                                    playerItem={playerItem}
                                    key={index}
                                />
                            ))}
                            <BuyCard />
                        </div>

                        {paginate.data.length === 0 && (
                            <div className="rounded-2xl flex items-center justify-center border border-default-100 w-full h-40">
                                <p className="text-default-100">No items</p>
                            </div>
                        )}
                    </CardBody>

                    <CardFooter>
                        <Pagination
                            isDisabled={isLoading}
                            paginate={paginate}
                        />
                    </CardFooter>
                </Card>
            </div>
        </Layout>
    );
}
