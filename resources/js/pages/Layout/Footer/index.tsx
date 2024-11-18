import Logo from "@/components/Logo";
import { cn } from "@/shared/helpers";
import { Link } from "@inertiajs/react";
import { Divider, Link as NextUILink } from "@nextui-org/react";

type Props = {
    className?: string;
};

export default function Footer({ className }: Props) {
    return (
        <footer className={cn(className, "w-full max-w-screen-xl mx-auto py-4 md:py-8")}>
            <div className="sm:flex sm:items-center sm:justify-between">
                <NextUILink
                    as={Link}
                    href="/"
                >
                    <Logo />
                </NextUILink>
            </div>

            <Divider className="my-5" />

            <span className="block text-sm text-gray-500 sm:text-center">©2024 All Rights Reserved</span>
        </footer>
    );
}
