import ModalAuth from "@/modules/Auth/components/ModalAuth";
import LiveDropList from "@/modules/LiveDrop/components/LiveDropList";
import ModalWheel from "@/modules/Wheel/components/ModalWheel";
import Footer from "@/pages/Layout/Footer";
import Header from "@/pages/Layout/Header";
import { APP_NAME } from "@/shared/constants";
import { cn } from "@/shared/helpers";
import { Head, usePage } from "@inertiajs/react";
import { useEffect } from "react";
import { toast, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

type Props = {
    children?: React.ReactNode;
};

export default function Layout({ children }: Props) {
    const { meta, flash } = usePage<any>().props;

    useEffect(() => {
        if (flash.error) toast.error(flash.error);
        if (flash.info) toast.info(flash.info);
        if (flash.success) toast.success(flash.success);
    }, [flash]);

    return (
        <div className={cn("flex flex-col w-full h-full min-h-screen bg-background relative")}>
            <Head title={meta.title || APP_NAME} />
            <Header />
            <LiveDropList />
            <main className={cn("grow w-full flex flex-col max-w-screen-xl mx-auto relative")}>{children}</main>
            <Footer className="mt-auto" />
            <ToastContainer
                theme="dark"
                stacked
                closeOnClick
                hideProgressBar={true}
                position="bottom-center"
            />
            <ModalAuth />
            <ModalWheel className="fixed bottom-5 sm:bottom-10 z-40 right-5 sm:right-10" />
        </div>
    );
}
