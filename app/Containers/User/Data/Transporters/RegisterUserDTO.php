<?php

namespace App\Containers\User\Data\Transporters;

use Spatie\LaravelData\Data;

class RegisterUserDTO extends Data
{
    public string $name;
    public string $email;
    public string $password;
}

