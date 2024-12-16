import { IPlayer } from "@/modules/Player/types";
import { Link } from "@inertiajs/react";
import { Avatar, Dropdown, DropdownItem, DropdownMenu, DropdownTrigger, NavbarItem } from "@nextui-org/react";
import { FaDollarSign, FaUser } from "react-icons/fa";
import { IoExit } from "react-icons/io5";

type Props = {
    player: IPlayer;
};

export default function Auth({ player }: Props) {
    return (
        <>
            <NavbarItem>
                <Dropdown
                    backdrop="blur"
                    className="text-foreground"
                >
                    <DropdownTrigger className="cursor-pointer">
                        <div className="flex gap-2 items-center">
                            <Avatar
                                size="sm"
                                isBordered
                                color="default"
                                src={player.image}
                            />
                            <div className="flex flex-col">
                                <p className="text-white text-sm">{player.name}</p>
                                <small className="text-white inline-flex items-center">
                                    <FaDollarSign className="text-success" />
                                    <span>{player.balance}</span>
                                </small>
                            </div>
                        </div>
                    </DropdownTrigger>

                    <DropdownMenu aria-label="Actions">
                        <DropdownItem textValue="Profile">
                            <Link href={route("page.profile")}>
                                <span className="flex gap-1 items-center">
                                    <FaUser />
                                    <span>Profile</span>
                                </span>
                            </Link>
                        </DropdownItem>

                        <DropdownItem textValue="Logout">
                            <Link
                                className="text-danger"
                                color="danger"
                                href={route("auth.logout")}
                            >
                                <span className="flex gap-1 items-center">
                                    <IoExit />
                                    <span>Logout</span>
                                </span>
                            </Link>
                        </DropdownItem>
                    </DropdownMenu>
                </Dropdown>
            </NavbarItem>
        </>
    );
}
