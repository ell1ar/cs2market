import { cn } from "@/shared/helpers";
import { PropsWithChildren } from "react";
import { FaCircleCheck } from "react-icons/fa6";

type Props<T> = {
    className?: string;
    isSelected: boolean;
    variant?: "danger" | "secondary";
    onClickSelectItem: () => void;
};

export default function Selectable<T = any>({ className, isSelected, onClickSelectItem, children, variant = "secondary" }: PropsWithChildren<Props<T>>) {
    const classNames = {
        secondary: {
            wrapper: "from-secondary/10",
            icon: "text-secondary",
        },
        danger: {
            wrapper: "from-danger/10",
            icon: "text-danger",
        },
    }[variant];

    const onClick = () => {
        onClickSelectItem();
    };

    return (
        <button
            className={cn(className, "group relative overflow-hidden  transition-all duration-300")}
            onClick={onClick}
        >
            {isSelected && (
                <div
                    className={cn(
                        classNames.wrapper,
                        "pointer-events-none absolute left-0 top-0 z-20 flex h-full w-full items-center justify-center overflow-hidden bg-gradient-to-tl"
                    )}
                >
                    <div className={cn(classNames.icon, "absolute bottom-2 right-2 h-5 w-5 rounded-[2px]")}>
                        <FaCircleCheck />
                    </div>
                </div>
            )}

            {children}
        </button>
    );
}
