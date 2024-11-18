import { useStoreModal } from "@/shared/store";
import { usePage } from "@inertiajs/react";
import { Button, Modal, ModalBody, ModalContent, ModalFooter, ModalHeader } from "@nextui-org/react";
import { FaSteam, FaTelegram, FaVk } from "react-icons/fa";

type Props = {};

export default function ModalAuth({}: Props) {
    const { social } = usePage<any>().props;
    const { setIsModalAuthOpen } = useStoreModal((state) => state.actions);
    const isModalAuthOpen = useStoreModal((state) => state.isModalAuthOpen);

    return (
        <Modal
            size="xs"
            isOpen={isModalAuthOpen}
            placement={"auto"}
            onClose={() => setIsModalAuthOpen(false)}
        >
            <ModalContent>
                {(onClose) => (
                    <>
                        <ModalHeader className="flex flex-col gap-1 text-white font-bold text-2xl">Sign In</ModalHeader>

                        <ModalBody>
                            <div className="flex flex-col w-full gap-1 font-bold">
                                {social.isSteamAuth && (
                                    <Button
                                        as={"a"}
                                        variant="solid"
                                        className="gap-1"
                                        href={route("auth", "steam")}
                                    >
                                        <FaSteam className="text-xl" />
                                        <span>Continue with Steam</span>
                                    </Button>
                                )}

                                {social.isTelegramAuth && (
                                    <Button
                                        as={"a"}
                                        variant="solid"
                                        className="gap-1"
                                        href={route("auth", "telegram")}
                                    >
                                        <FaTelegram className="text-xl text-sky-400" />
                                        <span>Continue with Telegram</span>
                                    </Button>
                                )}

                                {social.isVkAuth && (
                                    <Button
                                        as={"a"}
                                        variant="solid"
                                        className="gap-1"
                                        href={route("auth", "vk")}
                                    >
                                        <FaVk className="text-xl text-blue-400" />
                                        <span>Continue with VK</span>
                                    </Button>
                                )}
                            </div>
                        </ModalBody>

                        <ModalFooter />
                    </>
                )}
            </ModalContent>
        </Modal>
    );
}
