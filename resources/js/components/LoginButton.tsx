import { useAuthStoreModal } from "@/modules/Auth/store";
import { Button } from "@nextui-org/react";

type Props = {};

export default function LoginButton({}: Props) {
    const actions = useAuthStoreModal((state) => state.actions);

    return (
        <>
            <Button
                onClick={() => actions.setIsModalAuthOpen(true)}
                variant="bordered"
                className="gap-1"
            >
                <span>Login</span>
            </Button>
        </>
    );
}
