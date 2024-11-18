import { IItem } from "@/modules/Item/types";

export enum PlayerItemStatus {
    READY = 1,
    SELL = 0,
    TRADED = 5,
    TRADE_WAIT = 2,
    TRADE_PROCESS = 3,
}

export interface IPlayerItem extends IItem {
    uniqid: string;
    status: PlayerItemStatus;
}

export interface ISafePlayerItem extends IItem {}
