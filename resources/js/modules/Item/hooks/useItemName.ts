export default function useItemName(marketHashName: string) {
    const tmp = marketHashName.split("|");
    const topName = tmp[0];
    const bottomName = tmp[1]?.replace(/\s*\(.*?\)/g, "");
    return { topName, bottomName };
}
