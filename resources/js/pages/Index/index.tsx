import { HeroHighlight } from "@/components/HeroHighlight";
import LiveMarketTradeList from "@/modules/LiveMarketTrade/components/LiveMarketTradeList";
import StatisticsList from "@/modules/Statistics/components/List";
import Layout from "@/pages/Layout";
import { Button } from "@nextui-org/react";
import { useTranslation } from "react-i18next";
import { BsFillLightningChargeFill } from "react-icons/bs";
import { IoShield } from "react-icons/io5";
import { RiTimer2Fill } from "react-icons/ri";
import Typewriter from "typewriter-effect";

type Props = {
    statistics: { title: string; value: string }[];
};

const features = [
    {
        title: "PROFITABLE",
        icon: BsFillLightningChargeFill,
        desc: "The best prices for instant sales",
    },
    {
        title: "INSTANT PAYMENTS",
        icon: RiTimer2Fill,
        desc: "Average time of pay is 5 minutes",
    },
    {
        title: "WITHOUT HIDDEN COMMISSIONS",
        icon: IoShield,
        desc: "You immediately see the final amount of payment",
    },
];

export default function Index({ statistics }: Props) {
    const { t } = useTranslation();

    return (
        <Layout classNames={{ main: "" }}>
            <HeroHighlight className="relative">
                <section className="max-w-6xl mx-auto grid grid-cols-3 relative pb-10">
                    <div className="col-span-2 flex flex-col items-start relative z-10 justify-center">
                        <h2 className="text-6xl text-white uppercase font-bold">
                            <span className="title">CS2</span> <span>skins</span>{" "}
                            <Typewriter
                                options={{
                                    cursor: "|",
                                    strings: ["Sell", "Buy"],
                                    autoStart: true,
                                    loop: true,
                                    delay: 300,
                                    wrapperClassName: "title",
                                }}
                                component={"span"}
                            />{" "}
                        </h2>

                        <Button
                            color="secondary"
                            className="px-20 mt-4"
                            size="lg"
                        >
                            Get Started
                        </Button>

                        <div className="grid grid-cols-4 mt-10">
                            {features.map((f) => (
                                <div>
                                    <span className="inline-flex items-center gap-0.5">
                                        <f.icon className="text-secondary text-2xl" />
                                        <span className="text-white text-sm truncate font-bold uppercase">{f.title}</span>
                                    </span>
                                    <p className="text-xs text-default-600 leading-3">{f.desc}</p>
                                </div>
                            ))}
                        </div>
                    </div>

                    <div className="col-span-1 flex flex-col items-center relative z-10">
                        <div className="rounded-full w-96 flex flex-col items-center justify-center aspect-square bg-purple-500 bg-opacity-10 border-8 border-purple-500">
                            <img
                                className="rotate-[20deg] scale-150 [filter:drop-shadow(2px_4px_3px_#000000)]"
                                src="https://egamersworld.com/_next/image?url=https%3A%2F%2Fimg.egamersworld.com%2Fweapons%2Fak-47-vulcan%2FEMx53Ge.png&w=3840&q=75"
                                alt=""
                            />
                        </div>
                    </div>
                </section>
            </HeroHighlight>

            <section className="h-24 w-full bg-default-100">
                <div className="max-w-6xl mx-auto items-center h-full flex"></div>
            </section>

            <section className="max-w-6xl mx-auto w-full items-center flex flex-col mt-10">
                <h2 className="text-border text-5xl uppercase font-bold">{t("Last trades")}</h2>

                <LiveMarketTradeList className="w-full" />

                <StatisticsList
                    className="mt-5"
                    statistics={statistics}
                />
            </section>
        </Layout>
    );
}
