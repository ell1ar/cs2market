import Logo from "@/components/Logo";
import CurrencySelect from "@/modules/Currency/components/Select";
import Auth from "@/pages/Layout/Header/Auth";
import Guest from "@/pages/Layout/Header/Guest";
import { Link, usePage } from "@inertiajs/react";
import { Navbar, NavbarBrand, NavbarContent, NavbarItem, Link as NextUILink } from "@nextui-org/react";

export default function Header() {
    const { props } = usePage<InertiaPageProps>();

    return (
        <Navbar
            shouldHideOnScroll
            classNames={{
                base: "bg-content1/90 backdrop-blur-sm",
                wrapper: "!max-w-6xl mx-auto px-0",
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

            <NavbarContent
                className="hidden sm:flex gap-4"
                justify="center"
            >
                <NavbarItem value={"Sell skins"}>
                    <NextUILink
                        as={Link}
                        color="foreground"
                        href={route("page.sell")}
                    >
                        Продать скины
                    </NextUILink>
                </NavbarItem>

                <NavbarItem value={"Buy skins"}>
                    <NextUILink
                        as={Link}
                        color="foreground"
                        href={route("page.buy")}
                    >
                        Купить скины
                    </NextUILink>
                </NavbarItem>
            </NavbarContent>

            <NavbarContent justify="end">
                <NavbarItem value={"Currency"}>
                    <CurrencySelect />
                </NavbarItem>
                <NavbarItem value={"Panel"}>{!props.auth.player ? <Guest /> : <Auth player={props.auth.player} />}</NavbarItem>
            </NavbarContent>
        </Navbar>
    );
}
