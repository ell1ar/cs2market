import { IItem } from "@/modules/Item/types";
import { ISafePlayer } from "@/modules/Player/types";

export default interface ILiveDrop {
    player: ISafePlayer;
    item: IItem;
    meta: any;
    uid: string;
    time: number;
}
