<?php

namespace App\Containers\Player\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class TradeLinkRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $regexp = '!https://steamcommunity.com/tradeoffer/new/\?partner=([0-9]+)&([a-z0-9])!';
        if (!preg_match($regexp, $value)) $fail('Invalid trade link.');
    }
}
