<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    use HasFactory;

    protected $table = 'notification_preferences';

    protected $fillable = [
        'user_id',
        'before_prayer_minutes',
        'reminders_enabled',
        'friday_reminder',
        'ramadan_reminder',
        'special_occasions',
        'meta',
    ];

    protected $casts = [
        'before_prayer_minutes' => 'integer',
        'reminders_enabled' => 'boolean',
        'friday_reminder' => 'boolean',
        'ramadan_reminder' => 'boolean',
        'special_occasions' => 'boolean',
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
