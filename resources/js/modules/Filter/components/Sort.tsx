import SortAsc from "./icons/SortAsc";
import SortDesc from "./icons/SortDesc";

type Props = {
    key: string;
    onChange: ({ direction, key }: { direction: string; key: string }) => void;
    sort: string;
};

export default function Sort({ onChange, key, sort }: Props) {
    const sortKey = sort === "" ? "" : sort.split(":")[0];
    const direction = sort !== "" && sortKey === key ? sort.split(":")[1] : "asc";

    const toggle = () => {
        const newDirection = direction === "asc" ? "desc" : "asc";
        onChange({ direction: newDirection, key });
    };

    return (
        <button
            className="text-white/50"
            onClick={toggle}
        >
            {direction === "desc" ? <SortDesc /> : <SortAsc />}
        </button>
    );
}
