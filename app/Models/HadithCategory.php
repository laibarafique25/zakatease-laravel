<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HadithCategory extends Model
{
    use HasFactory;

    protected $table = 'hadith_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function hadiths()
    {
        return $this->hasMany(Hadith::class, 'category_id');
    }
}
