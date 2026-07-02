<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\PrayerLog;
use App\Models\PrayerStreak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPanelController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalDonated = Donation::where('user_id', $user->id)->where('status', 'completed')->sum('amount') ?? 0;
        $donationCount = Donation::where('user_id', $user->id)->count();
        
        $streak = PrayerStreak::where('user_id', $user->id)->first();
        $prayedTodayCount = PrayerLog::where('user_id', $user->id)
            ->whereDate('date', today())
            ->whereIn('status', ['prayed', 'jamaat', 'late'])
            ->count();

        $recentDonations = Donation::with('campaign')
            ->where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        $recentPrayers = PrayerLog::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('user.dashboard', compact('user', 'totalDonated', 'donationCount', 'streak', 'prayedTodayCount', 'recentDonations', 'recentPrayers'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $data['name'];
        $user->phone = $data['phone'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function donations()
    {
        $user = Auth::user();
        $donations = Donation::with('campaign', 'organization')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('user.donations', compact('donations'));
    }

    public function zakat()
    {
        $user = Auth::user();
        return view('user.zakat', compact('user'));
    }

    public function prayers()
    {
        $user = Auth::user();
        $logs = PrayerLog::where('user_id', $user->id)
            ->latest()
            ->paginate(15);
            
        $streak = PrayerStreak::where('user_id', $user->id)->first();

        return view('user.prayers', compact('logs', 'streak'));
    }

    public function bookmarks()
    {
        $user = Auth::user();
        // Since bookmark table is not fully created in migrations, we will simulate bookmarks
        // of Hadiths and Quran verses in the session or database metadata.
        $bookmarks = session()->get('bookmarks', [
            'hadith' => [],
            'quran' => []
        ]);

        return view('user.bookmarks', compact('bookmarks'));
    }
}
