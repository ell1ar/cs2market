import React from "react";

type Props = {
    title: string;
    value: string;
};

export default function Item({ title, value }: Props) {
    return (
        <div className="flex flex-col items-center px-4 py-2">
            <span className="text-foreground text-2xl font-bold">{value}</span>
            <span className="text-default-500">{title}</span>
        </div>
    );
}
