<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Models\Settings;

final class GetSettingsTask
{
    public function run(): Settings|null
    {
        return Settings::first();
    }
}
