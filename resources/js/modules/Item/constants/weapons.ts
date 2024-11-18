import ImageAgent from "@/modules/Item/assets/agent.svg";
import ImageAwp from "@/modules/Item/assets/awp.svg";
import ImageGloves from "@/modules/Item/assets/gloves.svg";
import ImagePistol from "@/modules/Item/assets/pistol.svg";
import ImageRifle from "@/modules/Item/assets/rifle.svg";
import ImageShotgun from "@/modules/Item/assets/shotgun.svg";
import ImageSubmachineGun from "@/modules/Item/assets/submachineGun.svg";
import { Weapon } from "@/modules/Item/types";

export const weapons = [
    { key: "rifle", title: "Rifles", img: ImageRifle },
    { key: "awp", title: "AWP", img: ImageAwp },
    { key: "shotgun", title: "Shotguns", img: ImageShotgun },
    { key: "pistol", title: "Pistols", img: ImagePistol },
    { key: "submachineGun", title: "SubmachineGuns", img: ImageSubmachineGun },
    { key: "gloves", title: "Gloves", img: ImageGloves },
    { key: "agent", title: "Agents", img: ImageAgent },
] as Weapon[];
