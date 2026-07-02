<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\PrayerLog;
use App\Models\QazaLog;
use App\Models\PrayerStreak;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PrayerManagementController extends Controller
{
    public function index()
    {
        $settings = [
            'prayer_api_url' => Setting::get('prayer_api_url', 'https://api.aladhan.com/v1'),
            'prayer_calculation_method' => Setting::get('prayer_calculation_method', '2'),
            'prayer_madhab' => Setting::get('prayer_madhab', '1'),
            'prayer_notifications_enabled' => Setting::get('prayer_notifications_enabled', 'true'),
            'default_city' => Setting::get('default_city', 'Karachi'),
            'default_country' => Setting::get('default_country', 'Pakistan'),
            'before_prayer_minutes' => Setting::get('before_prayer_minutes', '15'),
            'reminder_template_fajr' => Setting::get('reminder_template_fajr', 'Time for Fajr prayer. Recite Quran and seek blessings.'),
            'reminder_template_general' => Setting::get('reminder_template_general', 'Prayer is better than sleep. Make sure to pray on time.'),
        ];

        $recentLogs = PrayerLog::with('user')->latest()->paginate(15, ['*'], 'logs_page');
        
        $qazaStats = QazaLog::select('prayer_name')
            ->selectRaw('SUM(completed_count) as completed')
            ->selectRaw('SUM(remaining_count) as remaining')
            ->groupBy('prayer_name')
            ->get();

        $streaks = PrayerStreak::with('user')->orderBy('daily_streak', 'desc')->limit(10)->get();

        return view('admin.prayers.index', compact('settings', 'recentLogs', 'qazaStats', 'streaks'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'prayer_api_url' => 'required|url',
            'prayer_calculation_method' => 'required|string',
            'prayer_madhab' => 'required|in:0,1',
            'prayer_notifications_enabled' => 'required|in:true,false',
            'default_city' => 'required|string|max:100',
            'default_country' => 'required|string|max:100',
            'before_prayer_minutes' => 'required|integer|min:1|max:120',
            'reminder_template_fajr' => 'required|string|max:500',
            'reminder_template_general' => 'required|string|max:500',
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, $value, 'prayer');
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'prayers',
            'description' => 'Updated Prayer API and reminder configurations.',
        ]);

        return back()->with('success', 'Prayer settings updated successfully.');
    }
}
