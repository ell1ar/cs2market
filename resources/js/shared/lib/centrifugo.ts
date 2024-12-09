import Centrifuge from "centrifuge";

// @ts-ignore
const centrifuge = new Centrifuge(import.meta.env.VITE_CENTRIFUGO_WS_CONNECTION);

if (typeof window !== "undefined") {
    centrifuge.connect();
}

export default centrifuge;
