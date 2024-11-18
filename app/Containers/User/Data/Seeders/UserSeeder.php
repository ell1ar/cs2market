<?php

namespace App\Containers\User\Data\Seeders;

use App\Ship\Data\BaseSeeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends BaseSeeder
{
    public function getPriority(): int
    {
        return 10;
    }

    public function run()
    {
        if (!app()->environment('production')) {
            Artisan::call('orchid:admin admin admin@admin.com password');
        }
    }
}
