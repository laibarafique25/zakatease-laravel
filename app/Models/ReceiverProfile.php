<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiverProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'father_name',
        'cnic',
        'dob',
        'gender',
        'marital_status',
        'total_family_members',
        'number_of_children',
        'monthly_income',
        'employment_status',
        'assistance_required',
        'bank_name',
        'iban',
        'easypaisa',
        'jazzcash',
        'address',
        'country',
        'province',
        'city',
        'cnic_front_path',
        'cnic_back_path',
        'income_proof_path',
        'disability_cert_path',
        'medical_report_path',
        'death_cert_path',
        'supporting_docs_path',
        'reason',
    ];

    protected $casts = [
        'dob' => 'date',
        'assistance_required' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
