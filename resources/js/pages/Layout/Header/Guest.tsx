import LoginButton from "@/components/LoginButton";
import { NavbarItem } from "@nextui-org/react";

export default function Guest() {
    return (
        <NavbarItem className="flex">
            <LoginButton />
        </NavbarItem>
    );
}
