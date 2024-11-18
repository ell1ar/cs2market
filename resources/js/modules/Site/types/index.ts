export interface ISite {
    id: number;
    position: number;
    price: string;
    link: string;
    image: string;
    promo: string;
    instruction: null;
    is_new: boolean;
    is_hot: boolean;
    is_vpn: boolean;
    is_vip: boolean;
    is_active: boolean;
}

export interface ISiteCategory {
    id: number;
    name: string;
    position: number;
    sites: ISite[];
}
