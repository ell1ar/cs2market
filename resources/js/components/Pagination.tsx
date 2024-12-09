import { TChangeQueryParamsFn, TQueryParams } from "@/modules/Filter/hooks/useQueryFilter";
import { Pagination as NextUIPagination } from "@nextui-org/react";

type Props<T> = {
    queryParams: TQueryParams;
    changeQueryParams: TChangeQueryParamsFn;
    isDisabled: boolean;
    paginate: TPaginate<T>;
};

export default function Pagination<T>({ queryParams, changeQueryParams, isDisabled, paginate }: Props<T>) {
    return (
        <NextUIPagination
            showControls
            isDisabled={isDisabled}
            total={paginate.last_page}
            initialPage={queryParams?.page ?? paginate.current_page}
            color={"secondary"}
            onChange={(page) => !!page && changeQueryParams({ value: page, key: "page" })}
        />
    );
}
