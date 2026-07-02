<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerStreak extends Model
{
    use HasFactory;

    protected $table = 'prayer_streaks';

    protected $fillable = [
        'user_id',
        'daily_streak',
        'weekly_streak',
        'monthly_streak',
        'yearly_streak',
        'last_prayed_date',
        'meta',
    ];

    protected $casts = [
        'daily_streak' => 'integer',
        'weekly_streak' => 'integer',
        'monthly_streak' => 'integer',
        'yearly_streak' => 'integer',
        'last_prayed_date' => 'date',
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
