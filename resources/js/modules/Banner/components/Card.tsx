import { Card, CardBody, Image } from "@nextui-org/react";
import { IBanner } from "../types";

type Props = {
    className?: string;
    banner: IBanner;
};

export default function BannerCard({ className, banner }: Props) {
    return (
        <Card
            shadow="sm"
            as={"a"}
            href={banner.link}
            target="_blank"
            isPressable
            classNames={{
                base: className,
            }}
        >
            <CardBody className="overflow-visible p-0 h-full relative z-0">
                <Image
                    classNames={{
                        wrapper: "h-full",
                    }}
                    shadow="sm"
                    radius="lg"
                    width="100%"
                    height="100%"
                    alt={"banner"}
                    className="w-full object-cover h-full"
                    src={banner.image}
                />
            </CardBody>
        </Card>
    );
}
