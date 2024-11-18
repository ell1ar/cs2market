<?php

namespace App\Containers\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ShopPurchase extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $fillable = [
        'player_id',
        'market_hash_name',
        'price',
        'quantity',
    ];
}
