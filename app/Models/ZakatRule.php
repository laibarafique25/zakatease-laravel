<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZakatRule extends Model
{
    use HasFactory;

    protected $table = 'zakat_rules';

    protected $fillable = [
        'asset_type',
        'title',
        'content',
        'islamic_references',
        'scholarly_explanations',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
