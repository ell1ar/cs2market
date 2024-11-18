import { Link } from "@inertiajs/react";
import React from "react";

type Props = {
    children: React.ReactNode;
    [key: string]: any;
} & React.ComponentProps<typeof Link>;

const LinkButton = React.forwardRef<HTMLButtonElement, Props>(({ children, ...props }, ref) => {
    return (
        <Link
            as="button"
            ref={ref}
            {...props}
        >
            {children}
        </Link>
    );
});

LinkButton.displayName = "LinkButton";

export default LinkButton;
