<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketRate extends Model
{
    protected $fillable = ['type', 'unit', 'price', 'currency', 'source'];
}
