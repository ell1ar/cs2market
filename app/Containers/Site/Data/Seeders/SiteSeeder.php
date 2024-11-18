<?php

namespace App\Containers\Site\Data\Seeders;

use App\Containers\Site\Models\Site;
use App\Containers\Site\Models\SiteCategory;
use App\Ship\Data\BaseSeeder;

class SiteSeeder extends BaseSeeder
{
    public function getPriority(): int
    {
        return 5;
    }

    public function run()
    {
        $faker = app(\Faker\Generator::class);

        $category = SiteCategory::create([
            'name' => $faker->name(),
            'position' => 1,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $sites[] = [
                'category_id' => $category->id,
                'position' => $i,
                'price' => 'Reward ' . $i . ' rub',
                'link' => '#',
                'image' => "https://via.assets.so/img.jpg?w=300&h=250&tc=#3c3c3c&bg=#e3e3e3",
                'promo' => 'XXX-XXX',
                'instruction' => null,
                'is_new' => rand(0, 1),
                'is_hot' => rand(0, 1),
                'is_vpn' => rand(0, 1),
                'is_vip' => rand(0, 1),
                'is_active' => true,
            ];
        }

        Site::insert($sites);
    }
}
