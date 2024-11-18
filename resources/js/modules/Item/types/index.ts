export type IItem = {
    id: number;
    marketHashName: string;
    price: number;
    rarity: string;
    quality: string;
    rarityWeigth: number;
};

export type IWeapon = {
    key: string;
    title: string;
    img: string;
};

export type IRarity = {
    key: string;
    title: string;
    color: string;
};
