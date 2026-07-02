<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QazaLog extends Model
{
    use HasFactory;

    protected $table = 'qaza_logs';

    protected $fillable = [
        'user_id',
        'prayer_name',
        'completed_count',
        'remaining_count',
        'completed_at',
        'meta',
    ];

    protected $casts = [
        'completed_count' => 'integer',
        'remaining_count' => 'integer',
        'completed_at' => 'date',
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
