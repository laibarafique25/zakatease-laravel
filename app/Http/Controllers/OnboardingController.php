<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DonorProfile;
use App\Models\ReceiverProfile;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OnboardingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'registration_type' => ['required', Rule::in(['donor', 'receiver_individual', 'receiver_organization'])],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        try {
            DB::beginTransaction();

            // Create Base User
            $role = 'user';
            if ($request->registration_type === 'donor') $role = 'donor';
            if ($request->registration_type === 'receiver_individual') $role = 'receiver';
            if ($request->registration_type === 'receiver_organization') $role = 'organization';

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => $role,
                'status' => 'inactive', // Requires verification
            ]);

            // Handle Profile Types
            if ($request->registration_type === 'donor') {
                $this->storeDonorProfile($request, $user);
            } elseif ($request->registration_type === 'receiver_individual') {
                $this->storeReceiverProfile($request, $user);
            } elseif ($request->registration_type === 'receiver_organization') {
                $this->storeOrganizationProfile($request, $user);
            }

            DB::commit();

            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Registration completed successfully. Your account is pending verification.',
                'redirect' => route('user.dashboard')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function storeDonorProfile(Request $request, User $user)
    {
        $profile = new DonorProfile();
        $profile->user_id = $user->id;
        $profile->father_name = $request->father_name;
        $profile->cnic = $request->cnic;
        $profile->dob = $request->dob;
        $profile->gender = $request->gender;
        
        $profile->address = $request->address;
        $profile->country = $request->country;
        $profile->province = $request->province;
        $profile->city = $request->city;
        $profile->postal_code = $request->postal_code;
        
        $profile->bank_name = $request->bank_name;
        $profile->account_title = $request->account_title;
        $profile->iban = $request->iban;
        $profile->preferred_donation_method = $request->preferred_donation_method;
        
        $profile->preferences = json_decode($request->preferences, true);

        // File uploads
        if ($request->hasFile('cnic_front')) {
            $profile->cnic_front_path = $request->file('cnic_front')->store('registrations/donors', 'public');
        }
        if ($request->hasFile('cnic_back')) {
            $profile->cnic_back_path = $request->file('cnic_back')->store('registrations/donors', 'public');
        }
        if ($request->hasFile('selfie')) {
            $profile->selfie_path = $request->file('selfie')->store('registrations/donors', 'public');
        }

        $profile->save();
    }

    private function storeReceiverProfile(Request $request, User $user)
    {
        $profile = new ReceiverProfile();
        $profile->user_id = $user->id;
        
        $profile->father_name = $request->father_name;
        $profile->cnic = $request->cnic;
        $profile->dob = $request->dob;
        $profile->gender = $request->gender;
        
        $profile->marital_status = $request->marital_status;
        $profile->total_family_members = $request->total_family_members;
        $profile->number_of_children = $request->number_of_children;
        $profile->monthly_income = $request->monthly_income;
        $profile->employment_status = $request->employment_status;
        
        $profile->assistance_required = json_decode($request->assistance_required, true);
        
        $profile->bank_name = $request->bank_name;
        $profile->iban = $request->iban;
        $profile->easypaisa = $request->easypaisa;
        $profile->jazzcash = $request->jazzcash;
        
        $profile->address = $request->address;
        $profile->country = $request->country;
        $profile->province = $request->province;
        $profile->city = $request->city;
        
        $profile->reason = $request->reason;

        // File uploads
        if ($request->hasFile('cnic_front')) {
            $profile->cnic_front_path = $request->file('cnic_front')->store('registrations/receivers', 'public');
        }
        if ($request->hasFile('cnic_back')) {
            $profile->cnic_back_path = $request->file('cnic_back')->store('registrations/receivers', 'public');
        }
        if ($request->hasFile('income_proof')) {
            $profile->income_proof_path = $request->file('income_proof')->store('registrations/receivers', 'public');
        }
        if ($request->hasFile('disability_cert')) {
            $profile->disability_cert_path = $request->file('disability_cert')->store('registrations/receivers', 'public');
        }
        if ($request->hasFile('medical_report')) {
            $profile->medical_report_path = $request->file('medical_report')->store('registrations/receivers', 'public');
        }
        if ($request->hasFile('death_cert')) {
            $profile->death_cert_path = $request->file('death_cert')->store('registrations/receivers', 'public');
        }
        if ($request->hasFile('supporting_docs')) {
            $profile->supporting_docs_path = $request->file('supporting_docs')->store('registrations/receivers', 'public');
        }

        $profile->save();
    }

    private function storeOrganizationProfile(Request $request, User $user)
    {
        $org = new Organization();
        $org->user_id = $user->id;
        $org->name = $request->org_name;
        $org->slug = \Illuminate\Support\Str::slug($request->org_name) . '-' . uniqid();
        $org->email = $request->email;
        $org->phone = $request->phone;
        
        $org->registration_number = $request->registration_number;
        $org->license_number = $request->license_number;
        $org->tax_number = $request->tax_number;
        $org->ntn = $request->ntn;
        $org->org_type = $request->org_type;
        $org->contact_person = $request->contact_person;
        
        $org->website = $request->website;
        $org->address = $request->address;
        $org->city = $request->city;
        
        $org->bank_name = $request->bank_name;
        $org->iban = $request->iban;
        $org->account_title = $request->account_title;
        
        $org->mission_statement = $request->mission_statement;
        $org->status = 'pending';

        // File uploads
        if ($request->hasFile('gov_reg_cert')) {
            $org->gov_reg_cert_path = $request->file('gov_reg_cert')->store('registrations/organizations', 'public');
        }
        if ($request->hasFile('ngo_license')) {
            $org->ngo_license_path = $request->file('ngo_license')->store('registrations/organizations', 'public');
        }
        if ($request->hasFile('tax_cert')) {
            $org->tax_cert_path = $request->file('tax_cert')->store('registrations/organizations', 'public');
        }
        if ($request->hasFile('org_logo')) {
            $org->logo = $request->file('org_logo')->store('registrations/organizations', 'public');
        }
        if ($request->hasFile('office_images')) {
            $org->office_images_path = $request->file('office_images')->store('registrations/organizations', 'public');
        }
        if ($request->hasFile('supporting_docs')) {
            $org->supporting_docs_path = $request->file('supporting_docs')->store('registrations/organizations', 'public');
        }

        $org->save();
    }
}
