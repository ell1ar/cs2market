<?php

namespace App\Containers\Wheel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Screen\AsSource;

class WheelPromocode extends Model
{
    use HasFactory, AsSource, Filterable, Sortable;

    protected $fillable = [
        'limit',
        'value'
    ];

    protected $allowedFilters = [
    ];

    protected $allowedSorts = [
    ];
}
