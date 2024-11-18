import { Switch } from "@nextui-org/react";
import { useEffect, useState } from "react";
import { useCookies } from "react-cookie";
import { FaMoon } from "react-icons/fa";
import { FaSun } from "react-icons/fa6";

export default function ThemeSwitcher() {
    const [cookies, setCookie] = useCookies(["theme"]);
    const [isSelected, setIsSelected] = useState(cookies?.theme === undefined || cookies?.theme === "dark");

    useEffect(() => {
        setCookie("theme", cookies?.theme === undefined || isSelected ? "dark" : "light");
        document.body.classList.toggle("dark", isSelected);
    }, [isSelected]);

    return (
        <div className="flex flex-col gap-2">
            <Switch
                isSelected={isSelected}
                onValueChange={() => setIsSelected(!isSelected)}
                startContent={<FaSun />}
                endContent={<FaMoon />}
            />
        </div>
    );
}
