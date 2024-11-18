declare namespace App.Containers.AiWriterSection.FullOrder.Data.Enums {
export type Status = 'wait_paid' | 'wait_generating' | 'generating' | 'generated';
}
declare namespace App.Containers.AiWriterSection.FullOrder.Data.Resources {
export type FullOrderResource = {
id: number;
previewOrder: App.Containers.AiWriterSection.PreviewOrder.Data.Resources.PreviewOrderResource;
wordJson: any;
status: App.Containers.AiWriterSection.FullOrder.Data.Enums.Status;
};
}
declare namespace App.Containers.AiWriterSection.Order.Data.Enums {
export type OrderType = 'project' | 'referat' | 'course' | 'text';
}
declare namespace App.Containers.AiWriterSection.PreviewOrder.Data.Enums {
export type Status = 'wait_generating' | 'generating' | 'generated';
}
declare namespace App.Containers.AiWriterSection.PreviewOrder.Data.Resources {
export type PreviewOrderResource = {
id: number;
title: string;
desc: string | null;
list: Array<any> | null;
content: Array<any> | null;
type: App.Containers.AiWriterSection.Order.Data.Enums.OrderType;
status: App.Containers.AiWriterSection.PreviewOrder.Data.Enums.Status;
};
}
declare namespace App.Containers.AntiplagiatSection.Order.Data.Enums {
export type PromocodeType = 'free' | 'sale';
export type Status = 0 | 1 | 2 | 4;
export type Type = 'free' | 'full';
}
declare namespace App.Containers.FAQ.Data.Resources {
export type FAQResource = {
id: number;
question: string;
answer: string;
isActive: boolean;
};
}
declare namespace App.Containers.PaymentSection.System.Data.Enums {
export type AaioMethod = 'cards_ru' | 'cards_ua' | 'cards_kz' | 'sbp' | 'sbp_sber' | 'sbp_tink' | 'qiwi' | 'perfectmoney' | 'yoomoney' | 'advcash' | 'payeer' | 'skins' | 'beeline_ru' | 'tele2' | 'megafon_ru' | 'mts_ru' | 'yota' | 'bitcoin' | 'bitcoincash' | 'ethereum' | 'tether_trc20' | 'tether_erc20' | 'tether_ton' | 'tether_polygon' | 'tether_bsc' | 'usdcoin_trc20' | 'usdcoin_erc20' | 'usdcoin_bsc' | 'bnb_bsc' | 'notcoin' | 'tron' | 'litecoin' | 'dogecoin' | 'dai_erc20' | 'dai_bsc' | 'dash' | 'monero' | 'coupon' | 'balance';
export type FreekassaMethod = 1 | 2 | 3 | 4 | 6 | 7 | 8 | 9 | 10 | 11 | 12 | 13 | 14 | 15 | 16 | 17 | 18 | 19 | 20 | 21 | 22 | 23 | 24 | 25 | 26 | 27 | 28 | 32 | 33 | 34 | 35 | 36 | 37 | 38 | 39 | 40 | 41 | 42 | 44;
export type NicepayMethod = 'sberbank_rub' | 'tinkoff_rub' | 'alfabank_rub' | 'raiffeisen_rub' | 'vtb_rub' | 'rnkbbank_rub' | 'sbp_rub' | 'yoomoney_rub' | 'advcash_rub' | 'payeer_rub' | 'monobank_uah' | 'privatbank_uah' | 'raiffeisen_uah' | 'advcash_kzt' | 'kaspibank_kzt' | 'halykbank_kzt' | 'jysanbank_kzt' | 'centercreditbank_kzt' | 'fortebank_kzt' | 'advcash_usd' | 'payeer_usd' | 'paypal_usd' | 'advcash_eur' | 'payeer_eur' | 'paypal_eur';
export type PaymentSystemSlug = 'freekassa' | 'skinsback' | 'skinify' | 'skinvend' | 'nicepay' | 'rukassa' | 'aaio';
export type RukassaMethod = 'card' | 'card_kzt' | 'card_uzs' | 'card_azn' | 'card_kgs' | 'skinpay' | 'yandexmoney' | 'payeer' | 'crypta' | 'sbp' | 'clever';
export type RukassaStatus = 'PAID' | 'IN PROCESS' | 'WAIT' | 'CANCEL';
export type Status = 'paid' | 'wait' | 'rejected' | 'expired';
}
declare namespace App.Containers.PaymentSection.System.Data.Resources {
export type PaymentPromocodeResource = {
resource: any;
with: Array<any>;
additional: Array<any>;
};
export type PaymentSystemCategoryResource = {
id: number;
name: string;
slug: string;
};
export type PaymentSystemDirectionResource = {
id: number;
name: string;
image: string;
additionalInfo: Array<any> | null;
requiredFields: Array<object> | null;
currency: string;
isActive: boolean;
categories: Array<any>;
};
}
