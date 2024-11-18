<?php

namespace App\Ship\Data;

use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
    abstract public function getPriority(): int;
}
