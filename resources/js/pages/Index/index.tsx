import BannerCard from "@/modules/Banner/components/Card";
import { IBanner } from "@/modules/Banner/types";
import SiteCard from "@/modules/Site/components/Card";
import { ISiteCategory } from "@/modules/Site/types";
import Layout from "@/pages/Layout";
import { Divider } from "@nextui-org/react";

type Props = {
    siteCategories: ISiteCategory[];
    banners: IBanner[];
};

export default function Index({ siteCategories, banners }: Props) {
    return (
        <Layout>
            <div className="grid grid-cols-12 py-5 gap-2 ">
                <div className="col-span-2 hidden lg:flex flex-col gap-2">
                    {banners
                        .filter((b) => b.type === "left")
                        .map((banner, index) => (
                            <BannerCard
                                key={index}
                                banner={banner}
                            />
                        ))}
                </div>

                <div className="col-span-12 lg:col-span-8 flex flex-col gap-2">
                    {banners
                        .filter((b) => b.type === "top")
                        .map((banner, index) => (
                            <BannerCard
                                key={index}
                                banner={banner}
                            />
                        ))}

                    {siteCategories.map((siteCategory, i) => (
                        <div
                            className="flex flex-col gap-2"
                            key={i}
                        >
                            <h2 className="text-white font-bold text-center text-2xl">{siteCategory.name}</h2>
                            <Divider />
                            <div className="gap-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 place-content-start">
                                {siteCategory.sites.map((site, k) => (
                                    <SiteCard
                                        key={k}
                                        site={site}
                                    />
                                ))}
                            </div>
                        </div>
                    ))}
                </div>

                <div className="col-span-2 hidden lg:flex flex-col gap-2">
                    {banners
                        .filter((b) => b.type === "right")
                        .map((banner, index) => (
                            <BannerCard
                                key={index}
                                banner={banner}
                            />
                        ))}
                </div>
            </div>
        </Layout>
    );
}
