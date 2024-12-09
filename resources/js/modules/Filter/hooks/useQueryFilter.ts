import qs from "qs";
import { useEffect, useLayoutEffect, useState } from "react";

type TChangeQueryParams = { value: string | number | string[]; key: string };
type TChangeQueryParams2 = { isMultiple: boolean };
export type TChangeQueryParamsFn = (params: TChangeQueryParams, params2?: TChangeQueryParams2) => void;
export type TQueryParams = Record<string, any> | null;

export function useQueryFilter() {
    const [query, setQuery] = useState("");
    const [queryParams, setQueryParams] = useState<Record<string, any> | null>(null);
    const [prevQuery, setPrevQuery] = useState("");

    const changeQueryParams = ({ value, key }: TChangeQueryParams, { isMultiple }: TChangeQueryParams2 = { isMultiple: false }) => {
        setQueryParams((prev) => {
            if (isMultiple) return { ...prev, [key]: { $contains: value } };
            return { ...prev, [key]: value };
        });
    };

    const init = (query: string) => {
        const parsedQuery = qs.parse(query);
        if (parsedQuery) setQueryParams(parsedQuery);
    };

    useLayoutEffect(() => {
        init(new URLSearchParams(window.location.search).toString());
    }, []);

    useEffect(() => {
        setPrevQuery(query);
        setQuery(qs.stringify(queryParams));
    }, [queryParams]);

    return {
        query,
        queryParams,
        changeQueryParams,
        isDirty: prevQuery !== query,
    };
}
