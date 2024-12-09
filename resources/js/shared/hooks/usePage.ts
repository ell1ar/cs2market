import { usePage as useBasePage } from "@inertiajs/react";

const usePage = <T = {}>() => {
    return useBasePage<T & InertiaPageProps>();
};

export default usePage;
