<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use App\Models\Campaign;
use App\Models\PrayerLog;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Zakat and Sadaqa donation splits
        $zakatSum = Donation::where('status', 'completed')->where('type', 'zakat')->sum('amount') ?? 0;
        $sadaqaSum = Donation::where('status', 'completed')->where('type', 'sadaqa')->sum('amount') ?? 0;
        $generalSum = Donation::where('status', 'completed')->where('type', 'general')->sum('amount') ?? 0;
        $emergencySum = Donation::where('status', 'completed')->where('type', 'emergency')->sum('amount') ?? 0;

        // 2. User registration counts
        $rolesCount = User::select('role', \DB::raw('count(*) as total'))
            ->groupBy('role')
            ->get();

        // 3. Campaign Performance
        $topCampaigns = Campaign::with('organization')
            ->orderBy('raised_amount', 'desc')
            ->limit(5)
            ->get();

        // 4. Prayer logs overview
        $prayedOnTime = PrayerLog::whereIn('status', ['prayed', 'jamaat'])->count();
        $prayedLate = PrayerLog::where('status', 'late')->count();
        $qazaPrayers = PrayerLog::where('status', 'qaza')->count();
        $totalPrayers = PrayerLog::count();

        return view('admin.reports.index', compact(
            'zakatSum', 'sadaqaSum', 'generalSum', 'emergencySum',
            'rolesCount', 'topCampaigns', 'prayedOnTime', 'prayedLate',
            'qazaPrayers', 'totalPrayers'
        ));
    }

    public function export(Request $request)
    {
        $type = $request->input('type', 'donations');

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=report_{$type}_" . date('Ymd') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($type) {
            $file = fopen('php://output', 'w');

            if ($type === 'users') {
                fputcsv($file, ['ID', 'Name', 'Email', 'Role', 'Status', 'Verified', 'Created At']);
                $records = User::all();
                foreach ($records as $r) {
                    fputcsv($file, [$r->id, $r->name, $r->email, $r->role, $r->status, $r->is_verified ? 'Yes' : 'No', $r->created_at->toDateString()]);
                }
            } elseif ($type === 'campaigns') {
                fputcsv($file, ['ID', 'Title', 'Goal Amount', 'Raised Amount', 'Type', 'Status', 'Featured', 'Urgent']);
                $records = Campaign::all();
                foreach ($records as $r) {
                    fputcsv($file, [$r->id, $r->title, $r->goal_amount, $r->raised_amount, $r->type, $r->status, $r->is_featured ? 'Yes' : 'No', $r->is_urgent ? 'Yes' : 'No']);
                }
            } elseif ($type === 'prayers') {
                fputcsv($file, ['Log ID', 'User ID', 'Prayer Name', 'Status', 'Date', 'Location']);
                $records = PrayerLog::all();
                foreach ($records as $r) {
                    fputcsv($file, [$r->id, $r->user_id, $r->prayer_name, $r->status, $r->date, $r->city . ', ' . $r->country]);
                }
            } else { // default donations
                fputcsv($file, ['Transaction ID', 'Amount', 'Type', 'Status', 'Payment Method', 'Created At']);
                $records = Donation::all();
                foreach ($records as $r) {
                    fputcsv($file, [$r->transaction_id, $r->amount, $r->type, $r->status, $r->payment_method, $r->created_at->toDateTimeString()]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
