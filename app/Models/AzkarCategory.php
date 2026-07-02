<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzkarCategory extends Model
{
    use HasFactory;

    protected $table = 'azkar_categories';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'icon',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function azkar()
    {
        return $this->hasMany(Azkar::class, 'category_id');
    }
}
