import usePage from "@/shared/hooks/usePage";

export default function Logo() {
    const { props } = usePage();

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
                    <span>cs2</span>
                    <strong className="title">market</strong>
                </>
            )}
        </span>
    );
}
