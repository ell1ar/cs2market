import Logo from "@/components/Logo";
import Auth from "@/pages/Layout/Header/Auth";
import Guest from "@/pages/Layout/Header/Guest";
import { InertiaPageProps } from "@/shared/types/custom";
import { Link, usePage } from "@inertiajs/react";
import { Navbar, NavbarBrand, NavbarContent, Link as NextUILink } from "@nextui-org/react";

export default function Header() {
    const { props } = usePage<InertiaPageProps>();

    return (
        <Navbar
            shouldHideOnScroll
            classNames={{
                base: "bg-content1/90 backdrop-blur-sm",
                wrapper: "max-w-screen-xl mx-auto px-2",
            }}
        >
            <NavbarBrand>
                <NextUILink
                    as={Link}
                    href="/"
                >
                    <Logo />
                </NextUILink>
            </NavbarBrand>

            <NavbarContent justify="end">{!props.auth.player ? <Guest /> : <Auth player={props.auth.player} />}</NavbarContent>
        </Navbar>
    );
}
