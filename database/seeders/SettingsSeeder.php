<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Site Settings
            ['key' => 'site_name', 'value' => 'ZARIYAH', 'group' => 'site', 'type' => 'text', 'label' => 'Site Name'],
            ['key' => 'site_tagline', 'value' => 'Purify Wealth. Empower Lives.', 'group' => 'site', 'type' => 'text', 'label' => 'Site Tagline'],
            ['key' => 'site_email', 'value' => 'info@zariyah.com', 'group' => 'site', 'type' => 'text', 'label' => 'Support Email'],
            ['key' => 'currency', 'value' => 'PKR', 'group' => 'site', 'type' => 'text', 'label' => 'System Currency'],

            // Email Settings
            ['key' => 'mail_mailer', 'value' => 'smtp', 'group' => 'email', 'type' => 'text', 'label' => 'Mail Mailer'],
            ['key' => 'mail_host', 'value' => '127.0.0.1', 'group' => 'email', 'type' => 'text', 'label' => 'SMTP Host'],
            ['key' => 'mail_port', 'value' => '2525', 'group' => 'email', 'type' => 'text', 'label' => 'SMTP Port'],
            ['key' => 'mail_username', 'value' => null, 'group' => 'email', 'type' => 'text', 'label' => 'SMTP Username'],
            ['key' => 'mail_password', 'value' => null, 'group' => 'email', 'type' => 'text', 'label' => 'SMTP Password'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'group' => 'email', 'type' => 'text', 'label' => 'SMTP Encryption'],

            // Prayer API Settings
            ['key' => 'prayer_api_url', 'value' => 'https://api.aladhan.com/v1', 'group' => 'prayer', 'type' => 'text', 'label' => 'Prayer API Base URL'],
            ['key' => 'prayer_calculation_method', 'value' => '2', 'group' => 'prayer', 'type' => 'text', 'label' => 'Calculation Method (2 = ISNA)'],
            ['key' => 'prayer_madhab', 'value' => '1', 'group' => 'prayer', 'type' => 'text', 'label' => 'Madhab (1 = Hanafi, 0 = Shafi/Std)'],
            ['key' => 'prayer_notifications_enabled', 'value' => 'true', 'group' => 'prayer', 'type' => 'boolean', 'label' => 'Enable Notifications'],
            ['key' => 'default_city', 'value' => 'Karachi', 'group' => 'prayer', 'type' => 'text', 'label' => 'Default City'],
            ['key' => 'default_country', 'value' => 'Pakistan', 'group' => 'prayer', 'type' => 'text', 'label' => 'Default Country'],

            // Theme Settings
            ['key' => 'theme_mode', 'value' => 'light', 'group' => 'theme', 'type' => 'text', 'label' => 'Default Theme Mode'],

            // Security Settings
            ['key' => 'session_lifetime', 'value' => '120', 'group' => 'security', 'type' => 'text', 'label' => 'Session Lifetime (minutes)'],
            ['key' => 'password_min_length', 'value' => '8', 'group' => 'security', 'type' => 'text', 'label' => 'Minimum Password Length'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
