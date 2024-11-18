<?php

namespace App\Containers\Banner\Data\Seeders;

use App\Containers\Banner\Models\Banner;
use App\Ship\Data\BaseSeeder;

class BannerSeeder extends BaseSeeder
{
    public function getPriority(): int
    {
        return 5;
    }

    public function run()
    {
        Banner::create([
            'image' => 'https://via.assets.so/img.jpg?w=150&h=400&tc=#3c3c3c&bg=#e3e3e3',
            'link' => '#',
            'type' => "left",
            'position' => 1,
            'is_active' => true,
        ]);

        Banner::create([
            'image' => 'https://via.assets.so/img.jpg?w=150&h=400&tc=#3c3c3c&bg=#e3e3e3',
            'link' => '#',
            'type' => "right",
            'position' => 1,
            'is_active' => true,
        ]);

        Banner::create([
            'image' => 'https://via.assets.so/img.jpg?w=700&h=150&tc=#3c3c3c&bg=#e3e3e3',
            'link' => '#',
            'type' => "top",
            'position' => 1,
            'is_active' => true,
        ]);
    }
}
