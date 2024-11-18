import { create } from "zustand";
import { computed } from "zustand-computed";
import { immer } from "zustand/middleware/immer";

interface IStore {
    isModalAuthOpen: any;
    isModalWheelOpen: any;
    actions: {
        setIsModalAuthOpen: (value: any) => void;
        setIsModalWheelOpen: (value: any) => void;
    };
}

interface IComputedStore {}

const computedState = (state: IStore): IComputedStore => {
    return {};
};

export const useStoreModal = create<IStore>()(
    computed(
        immer((set, get) => ({
            isModalAuthOpen: false,
            isModalWheelOpen: false,
            actions: {
                setIsModalAuthOpen: (value) =>
                    set((state) => {
                        state.isModalAuthOpen = value;
                    }),
                setIsModalWheelOpen: (value) =>
                    set((state) => {
                        state.isModalWheelOpen = value;
                    }),
                closeAll: () =>
                    set((state) => {
                        state.isModalAuthOpen = false;
                        state.isModalWheelOpen = false;
                    }),
            },
        })),
        computedState
    )
);
