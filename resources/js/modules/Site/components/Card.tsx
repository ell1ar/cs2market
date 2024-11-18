import { Button, Card, CardBody, CardFooter, Chip, Image, Modal, ModalBody, ModalContent, ModalHeader, useDisclosure } from "@nextui-org/react";
import { ISite } from "../types";
import { Link } from "@inertiajs/react";

type Props = {
    site: ISite;
};

export default function SiteCard({ site }: Props) {
    const { isOpen, onOpen, onOpenChange } = useDisclosure();

    return (
        <Card
            shadow="sm"
            className="relative"
        >
            <div className="absolute top-1 right-1 flex gap-0.5 z-10">
                {site.is_hot && (
                    <Chip
                        color="danger"
                        size="sm"
                    >
                        HOT
                    </Chip>
                )}
                {site.is_new && (
                    <Chip
                        color="success"
                        size="sm"
                    >
                        NEW
                    </Chip>
                )}
                {site.is_vip && (
                    <Chip
                        color="warning"
                        size="sm"
                    >
                        VIP
                    </Chip>
                )}
                {site.is_vpn && (
                    <Chip
                        color="secondary"
                        size="sm"
                    >
                        VPN
                    </Chip>
                )}
            </div>

            <CardBody className="overflow-visible relative z-0">
                <Image
                    width="100%"
                    alt={"site"}
                    className="object-cover"
                    src={site.image}
                />
            </CardBody>

            <CardFooter className="text-small flex flex-col items-center">
                <p>{site.price}</p>
                <hr className="border-default-500 my-3 w-full" />
                <p>{site.promo}</p>
                <Button
                    as={"a"}
                    className="w-full mt-5"
                    variant="shadow"
                    target="_blank"
                    color="primary"
                    href={site.link}
                >
                    Get free
                </Button>

                <Button
                    className="w-full mt-1"
                    variant="shadow"
                    color="default"
                    onClick={onOpen}
                    isDisabled={!site.instruction}
                >
                    Instruction
                </Button>

                {site.instruction !== null && (
                    <Modal
                        size="xl"
                        isOpen={isOpen}
                        placement={"auto"}
                        onOpenChange={onOpenChange}
                    >
                        <ModalContent>
                            {(onClose) => (
                                <>
                                    <ModalHeader className="flex flex-col gap-1 text-white">Instruction</ModalHeader>
                                    <ModalBody>
                                        <div dangerouslySetInnerHTML={{ __html: site.instruction! }}></div>
                                    </ModalBody>
                                </>
                            )}
                        </ModalContent>
                    </Modal>
                )}
            </CardFooter>
        </Card>
    );
}
