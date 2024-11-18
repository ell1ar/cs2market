<?php

namespace App\Containers\Item\Data\Seeders;

use App\Ship\Data\BaseSeeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends BaseSeeder
{
    public function getPriority(): int
    {
        return 1;
    }
    public function run()
    {
        $path = 'app/Containers/Item/Data/Seeders/items.sql';
        DB::unprepared(file_get_contents($path));
    }
}
