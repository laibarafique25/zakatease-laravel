<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Azkar extends Model
{
    use HasFactory;

    protected $table = 'azkar';

    protected $fillable = [
        'category_id',
        'arabic_text',
        'urdu_translation',
        'english_translation',
        'reference',
        'benefits',
        'audio_path',
        'repeat_count',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'repeat_count' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(AzkarCategory::class, 'category_id');
    }
}
