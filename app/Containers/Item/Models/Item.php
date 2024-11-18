<?php

namespace App\Containers\Item\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Item extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $hidden = [
        'is_updatable'
    ];

    protected $allowedFilters = [
        'market_hash_name'
    ];

    protected $casts = [
        'is_updatable' => 'boolean'
    ];

    protected $fillable = [
        'market_hash_name',
        'ru_market_hash_name',
        'price',
        'price_market',
        'quantity',
        'quality',
        'rarity',
        'class_instance',
    ];

    protected function rarityWeigth(): Attribute
    {
        return Attribute::make(
            get: function () {
                switch ($this->rarity) {
                    case 'common':
                        return 7;
                    case 'uncommon':
                        return 6;
                    case 'milspec':
                        return 5;
                    case 'restricted':
                        return 4;
                    case 'classified':
                        return 3;
                    case 'covert':
                        return 2;
                    case 'rare':
                        return 1;
                    default:
                        return 0;
                }
            }
        );
    }
}
