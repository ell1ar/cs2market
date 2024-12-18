declare namespace App.Containers.Market.Data.Enums {
export type Market = 'skinvend' | 'skinify' | 'skinsback' | 'market_csgo';
export type MarketDepositStatus = 'success' | 'fail' | 'proccessing';
export type MarketTradeStatus = 'traded' | 'wait' | 'fail' | 'proccessing';
}
declare namespace App.Containers.Market.Data.Resources {
export type InventoryItemResource = {
name: string;
icon: string;
price: number;
quality: string | null;
tradable: boolean;
instanceId: string;
};
export type LiveMarketTradeResource = {
marketItem: App.Containers.Market.Data.Resources.MarketItemResource;
};
export type MarketDepositResource = {
uuid: string;
data: any;
market: App.Containers.Market.Data.Enums.Market;
status: App.Containers.Market.Data.Enums.MarketDepositStatus;
external_id: string;
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
classInstance: string;
market: App.Containers.Market.Data.Enums.Market;
};
}
declare namespace App.Containers.Player.Data.Resources {
export type PlayerResource = {
id: number;
name: string;
balance: number;
image: string;
tradeLink: string | null;
};
export type SafePlayerResource = {
id: number;
name: string;
image: string | null;
};
}
