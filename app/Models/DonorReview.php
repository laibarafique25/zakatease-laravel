<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonorReview extends Model
{
    protected $fillable = [
        'user_id', 'donor_name', 'city', 'donation_type', 'donation_amount',
        'review', 'rating', 'profile_image', 'is_verified', 'is_featured'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'donation_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
