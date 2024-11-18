import { Head } from "@inertiajs/react";
import Layout from "../Layout";

export default function Error({ status, message }: { status: number; message: string }) {
    return (
        <Layout>
            <Head title={message} />
            <div className="py-12 flex items-center justify-center grow flex-col text-dange">
                <h2 className="text-white text-3xl">{status}</h2>
                <p className="text-default-200">{message}</p>
            </div>
        </Layout>
    );
}
