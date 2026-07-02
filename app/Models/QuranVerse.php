<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuranVerse extends Model
{
    use HasFactory;

    protected $table = 'quran_verses';

    protected $fillable = [
        'topic_id',
        'surah_name',
        'surah_number',
        'ayah_number',
        'arabic_text',
        'urdu_translation',
        'english_translation',
        'reflection',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'surah_number' => 'integer',
        'ayah_number' => 'integer',
    ];

    public function topic()
    {
        return $this->belongsTo(QuranTopic::class, 'topic_id');
    }
}
