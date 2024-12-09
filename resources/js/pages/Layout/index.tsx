import ModalAuth from "@/modules/Auth/components/ModalAuth";
import LiveMarketTradeList from "@/modules/LiveMarketTrade/components/LiveMarketTradeList";
import Footer from "@/pages/Layout/Footer";
import Header from "@/pages/Layout/Header";
import { APP_NAME } from "@/shared/constants";
import { cn } from "@/shared/helpers";
import { Head, usePage } from "@inertiajs/react";
import { useEffect } from "react";
import { toast, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

type Props = {
    classNames?: Record<string, string>;
    children?: React.ReactNode;
};

export default function Layout({ classNames, children }: Props) {
    const { meta, flash } = usePage<any>().props;

    useEffect(() => {
        if (flash.error) toast.error(flash.error);
        if (flash.info) toast.info(flash.info);
        if (flash.success) toast.success(flash.success);
    }, [flash]);

    return (
        <div className={cn(classNames?.root, "flex flex-col w-full h-full min-h-screen bg-default-50/70 relative font-sans dark antialiased")}>
            <Head title={meta.title || APP_NAME} />
            <Header />
            <main className={cn(classNames?.main, "grow w-full flex flex-col relative mb-44")}>{children}</main>
            <Footer className="mt-auto" />
            <ToastContainer
                theme="dark"
                stacked
                closeOnClick
                hideProgressBar={true}
                position="bottom-center"
            />
            <ModalAuth />
        </div>
    );
}
