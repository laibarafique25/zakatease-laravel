<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'logo',
        'cover_image',
        'website',
        'phone',
        'email',
        'address',
        'city',
        'country',
        'status',
        'rejection_reason',
        'is_verified',
        'is_featured',
        'registration_number',
        'license_number',
        'tax_number',
        'ntn',
        'org_type',
        'contact_person',
        'bank_name',
        'iban',
        'account_title',
        'gov_reg_cert_path',
        'ngo_license_path',
        'tax_cert_path',
        'office_images_path',
        'supporting_docs_path',
        'mission_statement',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
