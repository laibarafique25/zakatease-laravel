<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NisabValue extends Model
{
    use HasFactory;

    protected $table = 'nisab_values';

    protected $fillable = [
        'type',
        'weight_grams',
        'value_pkr',
        'updated_by',
    ];

    protected $casts = [
        'weight_grams' => 'decimal:3',
        'value_pkr' => 'decimal:2',
    ];
}
