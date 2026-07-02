<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiKnowledgeBase extends Model
{
    use HasFactory;

    protected $table = 'ai_knowledge_base';

    protected $fillable = [
        'category',
        'question',
        'answer',
        'islamic_reference',
        'suggested_prompt',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
