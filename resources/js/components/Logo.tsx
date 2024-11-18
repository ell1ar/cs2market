import { InertiaPageProps } from "@/shared/types/custom";
import { usePage } from "@inertiajs/react";

export default function Logo() {
    const { props } = usePage<InertiaPageProps>();

    return (
        <span className="text-foreground text-3xl">
            {!!props.meta?.logo ? (
                <img
                    className="h-12 object-contain"
                    src={props.meta.logo}
                    alt="logo"
                />
            ) : (
                <>
                    <span>affiliate</span>
                    <strong className="bg-gradient-to-tr from-purple-300 to-purple-600 bg-clip-text text-transparent">pro</strong>
                </>
            )}
        </span>
    );
}
