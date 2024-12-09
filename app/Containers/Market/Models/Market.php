<?php

namespace App\Containers\Market\Item\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Market extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $fillable = [];
}
