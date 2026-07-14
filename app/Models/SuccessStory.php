<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    protected $fillable = [
        'user_id', 'full_name', 'city', 'user_type', 'title', 'story',
        'amount_received', 'profile_image', 'rating', 'is_verified', 'is_featured'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'amount_received' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
