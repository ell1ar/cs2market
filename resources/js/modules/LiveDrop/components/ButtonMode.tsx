import { cn } from "@/shared/helpers";
import React from "react";

type Props = {
    className?: string;
    isTop: boolean;
    children: React.ReactNode;
} & React.ComponentPropsWithoutRef<"button">;

export default function ButtonMode({ isTop, className, children, ...props }: Props) {
    const classNameButtonActive = "bg-primary text-content-3";
    const classNameButtonInActive = "bg-content-3 text-text-secondary";

    return (
        <button
            {...props}
            className={cn(className, isTop ? classNameButtonActive : classNameButtonInActive, "flex items-center justify-center rounded")}
        >
            {children}
        </button>
    );
}
