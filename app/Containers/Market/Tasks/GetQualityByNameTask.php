<?php

namespace App\Containers\Market\Tasks;

final class GetQualityByNameTask
{
    public function run(string $name)
    {
        $name = strtolower($name);
        $quality = null;
        if (strpos($name, 'battle-scarred') !== false) {
            $quality = 'BS';
        } elseif (strpos($name, 'well-worn') !== false) {
            $quality = 'WW';
        } elseif (strpos($name, 'field-tested') !== false) {
            $quality = 'FT';
        } elseif (strpos($name, 'minimal wear') !== false) {
            $quality = 'MW';
        } elseif (strpos($name, 'factory new') !== false) {
            $quality = 'FN';
        }
        return $quality;
    }
}
