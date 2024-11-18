export interface IBanner {
    id: number;
    image: string;
    type: string;
    position: "left" | "right" | "top";
    link: string;
    show: boolean;
    created_at: Date;
    updated_at: Date;
}
