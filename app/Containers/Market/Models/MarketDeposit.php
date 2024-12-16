<?php

namespace App\Containers\Market\Models;

use App\Containers\Market\Data\Enums\Market;
use App\Containers\Market\Data\Enums\MarketDepositStatus;
use App\Ship\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Abbasudo\Purity\Traits\Filterable as PurityFilterable;
use Abbasudo\Purity\Traits\Sortable as PuritySortable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class MarketDeposit extends Model
{
    use HasFactory, Filterable, AsSource, PurityFilterable, PuritySortable, UUID;

    protected $fillable = [
        'uuid',
        'data',
        'market',
        'status',
        'external_id',
    ];

    protected $casts = [
        'data' => 'json',
        'market' => Market::class,
        'status' => MarketDepositStatus::class
    ];
}
