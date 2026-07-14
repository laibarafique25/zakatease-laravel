<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerLog extends Model
{
    use HasFactory;

    protected $table = 'prayer_logs';

    protected $fillable = [
        'user_id',
        'prayer_name',
        'status',
        'date',
        'logged_at',
        'city',
        'country',
        'timezone',
        'meta',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
