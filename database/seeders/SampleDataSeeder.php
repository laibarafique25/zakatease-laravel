<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\ActivityLog;
use App\Models\PrayerLog;
use App\Models\DailyPrayerTiming;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create different types of users
        $orgUser = User::firstOrCreate(
            ['email' => 'contact@ehsaas.org'],
            [
                'name' => 'Ehsaas Foundation',
                'password' => Hash::make('Password@123'),
                'role' => 'organization',
                'status' => 'active',
                'is_verified' => true,
                'verified_at' => now(),
                'trust_score' => 95,
                'phone' => '+923001234567',
                'avatar' => null,
            ]
        );

        $orgUser2 = User::firstOrCreate(
            ['email' => 'info@alkhidmat.org'],
            [
                'name' => 'Al-Khidmat Foundation',
                'password' => Hash::make('Password@123'),
                'role' => 'organization',
                'status' => 'active',
                'is_verified' => true,
                'verified_at' => now(),
                'trust_score' => 98,
                'phone' => '+923007654321',
                'avatar' => null,
            ]
        );

        $donorUser = User::firstOrCreate(
            ['email' => 'donor@zariyah.com'],
            [
                'name' => 'Fatima Ahmed',
                'password' => Hash::make('Password@123'),
                'role' => 'donor',
                'status' => 'active',
                'is_verified' => true,
                'verified_at' => now(),
                'trust_score' => 100,
                'phone' => '+923334567890',
                'avatar' => null,
            ]
        );

        $donorUser2 = User::firstOrCreate(
            ['email' => 'ahsan@zariyah.com'],
            [
                'name' => 'Ahsan Khan',
                'password' => Hash::make('Password@123'),
                'role' => 'user',
                'status' => 'active',
                'is_verified' => false,
                'trust_score' => 50,
                'phone' => '+923219876543',
                'avatar' => null,
            ]
        );

        // 2. Create Organizations
        $org1 = Organization::updateOrCreate(
            ['slug' => 'ehsaas-foundation'],
            [
                'user_id' => $orgUser->id,
                'name' => 'Ehsaas Foundation',
                'description' => 'Ehsaas is a premium social safety net dedicated to reducing inequality and investing in people across Pakistan.',
                'logo' => null,
                'cover_image' => null,
                'website' => 'https://ehsaas.org',
                'phone' => '+923001234567',
                'email' => 'contact@ehsaas.org',
                'address' => 'G-9 Markaz, Islamabad',
                'city' => 'Islamabad',
                'country' => 'Pakistan',
                'status' => 'approved',
                'is_verified' => true,
                'is_featured' => true,
            ]
        );

        $org2 = Organization::updateOrCreate(
            ['slug' => 'al-khidmat-foundation'],
            [
                'user_id' => $orgUser2->id,
                'name' => 'Al-Khidmat Foundation',
                'description' => 'One of the leading, non-profit organizations in Pakistan, dedicated to humanitarian services since 1990.',
                'logo' => null,
                'cover_image' => null,
                'website' => 'https://alkhidmat.org',
                'phone' => '+923007654321',
                'email' => 'info@alkhidmat.org',
                'address' => 'Gulberg III, Lahore',
                'city' => 'Lahore',
                'country' => 'Pakistan',
                'status' => 'approved',
                'is_verified' => true,
                'is_featured' => false,
            ]
        );

        // 3. Create Campaigns
        $camp1 = Campaign::updateOrCreate(
            ['slug' => 'ramadan-food-packs-2026'],
            [
                'organization_id' => $org1->id,
                'user_id' => $orgUser->id,
                'title' => 'Ramadan Food Ration Packs',
                'description' => 'Provide essential food ration packs to deserving families across remote districts of Balochistan and Sindh.',
                'goal_amount' => 1500000.00,
                'raised_amount' => 1250000.00,
                'type' => 'zakat',
                'status' => 'approved',
                'is_featured' => true,
                'is_urgent' => true,
                'start_date' => now()->subMonth(),
                'end_date' => now()->addMonth(),
            ]
        );

        $camp2 = Campaign::updateOrCreate(
            ['slug' => 'clean-water-wells'],
            [
                'organization_id' => $org2->id,
                'user_id' => $orgUser2->id,
                'title' => 'Clean Water Solar Wells',
                'description' => 'Install solar-powered water filtration wells in water-scarce communities of Thar Desert.',
                'goal_amount' => 3000000.00,
                'raised_amount' => 1800000.00,
                'type' => 'sadaqa',
                'status' => 'approved',
                'is_featured' => false,
                'is_urgent' => false,
                'start_date' => now()->subWeeks(2),
                'end_date' => now()->addMonths(3),
            ]
        );

        $camp3 = Campaign::updateOrCreate(
            ['slug' => 'emergency-medical-aid'],
            [
                'organization_id' => $org1->id,
                'user_id' => $orgUser->id,
                'title' => 'Emergency Medical Aid Fund',
                'description' => 'Support treatments, surgeries, and medicines for underprivileged patients in public hospitals.',
                'goal_amount' => 800000.00,
                'raised_amount' => 50000.00,
                'type' => 'emergency',
                'status' => 'approved',
                'is_featured' => true,
                'is_urgent' => true,
                'start_date' => now(),
                'end_date' => now()->addWeeks(4),
            ]
        );

        // 4. Create Donations
        Donation::updateOrCreate(
            ['transaction_id' => 'TXN-9821739'],
            [
                'user_id' => $donorUser->id,
                'campaign_id' => $camp1->id,
                'organization_id' => $org1->id,
                'amount' => 50000.00,
                'type' => 'zakat',
                'status' => 'completed',
                'payment_method' => 'Credit Card',
                'notes' => 'May Allah accept it.',
                'is_anonymous' => false,
            ]
        );

        Donation::updateOrCreate(
            ['transaction_id' => 'TXN-2831920'],
            [
                'user_id' => $donorUser2->id,
                'campaign_id' => $camp2->id,
                'organization_id' => $org2->id,
                'amount' => 25000.00,
                'type' => 'sadaqa',
                'status' => 'completed',
                'payment_method' => 'Bank Transfer',
                'notes' => 'Sadaqa for family.',
                'is_anonymous' => true,
            ]
        );

        Donation::updateOrCreate(
            ['transaction_id' => 'TXN-4921029'],
            [
                'user_id' => null, // Guest
                'campaign_id' => $camp1->id,
                'organization_id' => $org1->id,
                'amount' => 100000.00,
                'type' => 'zakat',
                'status' => 'completed',
                'payment_method' => 'EasyPaisa',
                'notes' => null,
                'is_anonymous' => true,
            ]
        );

        Donation::updateOrCreate(
            ['transaction_id' => 'TXN-5920192'],
            [
                'user_id' => $donorUser->id,
                'campaign_id' => $camp3->id,
                'organization_id' => $org1->id,
                'amount' => 15000.00,
                'type' => 'emergency',
                'status' => 'pending',
                'payment_method' => 'JazzCash',
                'notes' => 'Urgent medical aid support.',
                'is_anonymous' => false,
            ]
        );

        // 5. Create Prayer logs
        $prayers = ['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
        foreach ($prayers as $prayer) {
            PrayerLog::updateOrCreate(
                [
                    'user_id' => $donorUser->id,
                    'prayer_name' => $prayer,
                    'date' => now()->toDateString(),
                ],
                [
                    'status' => 'prayed',
                    'logged_at' => now()->subHours(2),
                    'city' => 'Karachi',
                    'country' => 'Pakistan',
                    'timezone' => 'Asia/Karachi',
                ]
            );
        }

        // 6. Create Activity Logs
        ActivityLog::create([
            'user_id' => 1, // Super Admin
            'action' => 'login',
            'module' => 'auth',
            'description' => 'Super Admin logged in successfully.',
            'ip_address' => '127.0.0.1',
        ]);

        ActivityLog::create([
            'user_id' => 1,
            'action' => 'update',
            'module' => 'settings',
            'description' => 'System settings updated (SMTP Configuration).',
            'ip_address' => '127.0.0.1',
        ]);
    }
}
