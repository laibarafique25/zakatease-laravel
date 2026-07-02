<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerNotification extends Model
{
    use HasFactory;

    protected $table = 'prayer_notifications';

    protected $fillable = [
        'user_id',
        'notification_type',
        'scheduled_at',
        'delivered_at',
        'status',
        'payload',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'delivered_at' => 'datetime',
        'payload' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
