<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Personal Information
            $table->string('father_name')->nullable();
            $table->string('cnic')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            
            // Address
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            
            // Financial Information
            $table->string('bank_name')->nullable();
            $table->string('account_title')->nullable();
            $table->string('iban')->nullable();
            $table->string('preferred_donation_method')->nullable();
            
            // Preferences (JSON)
            $table->json('preferences')->nullable();
            
            // Identity Verification
            $table->string('cnic_front_path')->nullable();
            $table->string('cnic_back_path')->nullable();
            $table->string('selfie_path')->nullable();
            
            $table->timestamps();
        });

        Schema::create('receiver_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Personal Information
            $table->string('father_name')->nullable();
            $table->string('cnic')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            
            // Family Information
            $table->string('marital_status')->nullable();
            $table->integer('total_family_members')->nullable();
            $table->integer('number_of_children')->nullable();
            $table->decimal('monthly_income', 15, 2)->nullable();
            $table->string('employment_status')->nullable();
            
            // Assistance Required (JSON)
            $table->json('assistance_required')->nullable();
            
            // Financial Information
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('easypaisa')->nullable();
            $table->string('jazzcash')->nullable();
            
            // Address
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            
            // Verification Documents
            $table->string('cnic_front_path')->nullable();
            $table->string('cnic_back_path')->nullable();
            $table->string('income_proof_path')->nullable();
            $table->string('disability_cert_path')->nullable();
            $table->string('medical_report_path')->nullable();
            $table->string('death_cert_path')->nullable();
            $table->string('supporting_docs_path')->nullable();
            
            // Reason
            $table->text('reason')->nullable();
            
            $table->timestamps();
        });

        Schema::table('organizations', function (Blueprint $table) {
            // Check if columns exist before adding them
            if (!Schema::hasColumn('organizations', 'registration_number')) {
                $table->string('registration_number')->nullable()->after('status');
                $table->string('license_number')->nullable()->after('registration_number');
                $table->string('tax_number')->nullable()->after('license_number');
                $table->string('ntn')->nullable()->after('tax_number');
                $table->string('org_type')->nullable()->after('ntn');
                $table->string('contact_person')->nullable()->after('org_type');
                
                $table->string('bank_name')->nullable()->after('address');
                $table->string('iban')->nullable()->after('bank_name');
                $table->string('account_title')->nullable()->after('iban');
                
                $table->string('gov_reg_cert_path')->nullable()->after('logo');
                $table->string('ngo_license_path')->nullable()->after('gov_reg_cert_path');
                $table->string('tax_cert_path')->nullable()->after('ngo_license_path');
                $table->string('office_images_path')->nullable()->after('tax_cert_path');
                $table->string('supporting_docs_path')->nullable()->after('office_images_path');
                $table->text('mission_statement')->nullable()->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receiver_profiles');
        Schema::dropIfExists('donor_profiles');

        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn([
                'registration_number', 'license_number', 'tax_number', 'ntn', 'org_type', 'contact_person',
                'bank_name', 'iban', 'account_title',
                'gov_reg_cert_path', 'ngo_license_path', 'tax_cert_path', 'office_images_path', 'supporting_docs_path', 'mission_statement'
            ]);
        });
    }
};
