<?php

namespace App\Containers\Settings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'data',
    ];

    protected $casts = [
        'data' => 'json',
    ];
}
