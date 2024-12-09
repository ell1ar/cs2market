<?php

namespace App\Containers\Market\Models;

use App\Containers\Market\Data\Enums\Market;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable as PurityFilterable;
use Abbasudo\Purity\Traits\Sortable as PuritySortable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class MarketItem extends Model
{
    use HasFactory, Filterable, AsSource, PurityFilterable, PuritySortable;

    protected $fillable = [
        'name',
        'icon',
        'price',
        'quality',
        'rarity',
        'float',
        'stickers',
        'class_instance',
        'market',
        'market_info',
        'steam_info'
    ];

    protected $casts = [
        'stickers' => 'json',
        'market' => Market::class,
        'market_info' => 'json',
        'steam_info' => 'json'
    ];
}
