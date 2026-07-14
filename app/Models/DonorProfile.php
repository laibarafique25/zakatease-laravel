<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'father_name',
        'cnic',
        'dob',
        'gender',
        'address',
        'country',
        'province',
        'city',
        'postal_code',
        'bank_name',
        'account_title',
        'iban',
        'preferred_donation_method',
        'preferences',
        'cnic_front_path',
        'cnic_back_path',
        'selfie_path',
    ];

    protected $casts = [
        'dob' => 'date',
        'preferences' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
