import LoginButton from "@/components/LoginButton";
import ImagePromocodeWheel from "@/modules/Wheel/assets/box.png";
import Wheel from "@/modules/Wheel/components/Wheel";
import { ANIMATION_TRANSITION_MS } from "@/modules/Wheel/constants";
import { TWheelInfo } from "@/modules/Wheel/types";
import { cn, delay } from "@/shared/helpers";
import { useStoreModal } from "@/shared/store";
import { router, usePage } from "@inertiajs/react";
import { Button, Image, Input, Modal, ModalBody, ModalContent, ModalHeader, Spinner } from "@nextui-org/react";
import axios from "axios";
import { useEffect, useState } from "react";
import { toast } from "react-toastify";

type Props = {
    className?: string;
};

export default function ModalPromocodeWheel({ className }: Props) {
    const page = usePage();
    const isModalWheelOpen = useStoreModal((state) => state.isModalWheelOpen);
    const { setIsModalWheelOpen } = useStoreModal((state) => state.actions);
    const [isLoadingItems, setIsLoadingItems] = useState(false);
    const [promocodeValue, setPromocodeValue] = useState("");
    const [isOpening, setIsOpening] = useState(false);
    const isDisabledOpenWheelPromocode = promocodeValue === "" || isOpening || isLoadingItems;
    const [wheelInfo, setWheelInfo] = useState<TWheelInfo>({ items: [], winPlayerItem: null, isAnimating: false });

    const getWheelItems = async () => {
        setIsLoadingItems(true);
        try {
            const { data } = await axios.get("/api/box/promocode/items");
            if (data.status !== "success") return toast.error(data.error || "Something went wrong");
            setWheelInfo((prev) => ({ ...prev, items: data.data.items }));
        } catch (error) {
            toast.error("Something went wrong");
        } finally {
            setIsLoadingItems(false);
        }
    };

    const openWheelPromocode = async () => {
        setIsOpening(true);
        try {
            const params = { promocode_value: promocodeValue };
            const options = { withCredentials: true };
            const { data } = await axios.post("/api/box/promocode/open", params, options);
            if (data.status !== "success") return toast.error(data.error || "Something went wrong");
            setWheelInfo((prev) => ({ ...prev, winPlayerItem: data.data.winPlayerItem, isAnimating: true }));
            await delay(ANIMATION_TRANSITION_MS);
            setWheelInfo((prev) => ({ ...prev, isAnimating: false }));
            if (isModalWheelOpen) {
                setIsModalWheelOpen(false);
                router.visit(route("profile"));
            }
        } catch (error) {
            toast.error("Something went wrong");
        } finally {
            setIsOpening(false);
        }
    };

    useEffect(() => {
        if (isModalWheelOpen) getWheelItems();
    }, [isModalWheelOpen]);

    return (
        <div className={cn(className)}>
            <Button
                onClick={() => setIsModalWheelOpen(true)}
                disableRipple
                color="primary"
                variant="flat"
                className="rounded-full h-24 sm:h-32 w-24 sm:w-32 bg-default-50 backdrop-blur-sm"
            >
                <Image
                    className="w-full"
                    src={ImagePromocodeWheel}
                />
            </Button>

            <Modal
                size="3xl"
                classNames={{ body: "p-0 px-3" }}
                isOpen={isModalWheelOpen}
                placement={"auto"}
                onClose={() => setIsModalWheelOpen(false)}
            >
                <ModalContent>
                    {(onClose) => (
                        <>
                            <ModalHeader className="flex flex-col gap-1 text-white">Bonus wheel</ModalHeader>

                            <ModalBody>
                                <div className="grid grid-cols-3 relative h-[230px]">
                                    <div className="relative flex col-span-2 items-center justify-center">
                                        {isLoadingItems && (
                                            <Spinner
                                                label="Loading..."
                                                color="primary"
                                                labelColor="primary"
                                                size="lg"
                                            />
                                        )}

                                        {!isLoadingItems && wheelInfo?.items.length > 0 && (
                                            <Wheel
                                                className="absolute bottom-0 translate-y-[50%]"
                                                wheelInfo={wheelInfo}
                                            />
                                        )}

                                        <div className="w-full h-40 bg-gradient-to-t absolute bottom-0 via-content1/50 from-content1"></div>
                                    </div>

                                    <div className="flex col-span-1 flex-col gap-2 pb-3">
                                        <Input
                                            size="sm"
                                            type="text"
                                            value={promocodeValue}
                                            onChange={(e) => setPromocodeValue(e.target.value)}
                                            label="Promocode"
                                        />

                                        {page.props.auth.player && (
                                            <Button
                                                size="md"
                                                color="primary"
                                                onPress={openWheelPromocode}
                                                isDisabled={isDisabledOpenWheelPromocode}
                                                disabled={isDisabledOpenWheelPromocode}
                                            >
                                                Open box
                                            </Button>
                                        )}

                                        {!page.props.auth.player && <LoginButton />}

                                        <Button
                                            className="mt-auto"
                                            size="md"
                                            color="danger"
                                            variant="bordered"
                                            onPress={onClose}
                                        >
                                            Close
                                        </Button>
                                    </div>
                                </div>
                            </ModalBody>
                        </>
                    )}
                </ModalContent>
            </Modal>
        </div>
    );
}
