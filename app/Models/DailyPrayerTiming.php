<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPrayerTiming extends Model
{
    use HasFactory;

    protected $table = 'daily_prayer_timings';

    protected $fillable = [
        'date',
        'city',
        'country',
        'latitude',
        'longitude',
        'timezone',
        'method',
        'timings',
        'meta',
    ];

    protected $casts = [
        'timings' => 'array',
        'meta' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'date' => 'date',
    ];
}
