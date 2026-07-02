<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        
        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->value = is_array($value) ? json_encode($value) : $value;
                $setting->save();
            }
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'settings',
            'description' => 'System settings updated.',
        ]);

        return back()->with('success', 'Settings updated successfully.');
    }

    public function updateTheme(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark',
        ]);

        if (auth()->check()) {
            $user = auth()->user();
            $user->theme = $request->input('theme');
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
}
