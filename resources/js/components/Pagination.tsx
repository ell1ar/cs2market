import { router } from "@inertiajs/react";
import { Pagination as NextUIPagination } from "@nextui-org/react";

type Props = {
    isDisabled: boolean;
    paginate: any;
};

export default function Pagination({ isDisabled, paginate }: Props) {
    return (
        <NextUIPagination
            showControls
            isDisabled={isDisabled}
            total={paginate.meta.last_page}
            initialPage={paginate.meta.current_page}
            color={"primary"}
            onChange={(page) =>
                router.get(
                    paginate.meta.links[page].url,
                    {},
                    {
                        preserveState: true,
                        preserveScroll: true,
                    }
                )
            }
        />
    );
}
