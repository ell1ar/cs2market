declare namespace App.Containers.Market.Data.Enums {
export type Market = 'skinvend' | 'skinify' | 'skinsback' | 'market_csgo';
export type MarketTradeStatus = 'traded' | 'wait' | 'fail' | 'proccessing';
}
declare namespace App.Containers.Market.Data.Resources {
export type InventoryItemResource = {
name: string;
icon: string;
price: number;
quality: string | null;
tradable: boolean;
};
export type LiveMarketTradeResource = {
marketItem: App.Containers.Market.Data.Resources.MarketItemResource;
};
export type MarketItemResource = {
id: number;
name: string;
icon: string | null;
price: number;
quality: string | null;
rarity: string | null;
float: number | null;
stickers: Array<any> | null;
market: App.Containers.Market.Data.Enums.Market;
};
}
