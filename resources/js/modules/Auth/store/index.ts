import { create } from "zustand";
import { computed } from "zustand-computed";
import { immer } from "zustand/middleware/immer";

interface IStore {
    isModalAuthOpen: any;
    actions: {
        setIsModalAuthOpen: (value: any) => void;
    };
}

interface IComputedStore {}

const computedState = (state: IStore): IComputedStore => {
    return {};
};

export const useAuthStoreModal = create<IStore>()(
    computed(
        immer((set, get) => ({
            isModalAuthOpen: false,
            actions: {
                setIsModalAuthOpen: (value) =>
                    set((state) => {
                        state.isModalAuthOpen = value;
                    }),
                closeAll: () =>
                    set((state) => {
                        state.isModalAuthOpen = false;
                    }),
            },
        })),
        computedState
    )
);
