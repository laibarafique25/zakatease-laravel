<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuranTopic extends Model
{
    use HasFactory;

    protected $table = 'quran_topics';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function verses()
    {
        return $this->hasMany(QuranVerse::class, 'topic_id');
    }
}
