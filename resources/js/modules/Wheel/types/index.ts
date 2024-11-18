import { IItem } from "@/modules/Item/types";
import { IPlayerItem } from "@/modules/PlayerItem/types";

export type TWheelInfo = {
    items: IItem[];
    winPlayerItem: IPlayerItem | null;
    isAnimating: boolean;
};
