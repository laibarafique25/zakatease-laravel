<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Organization;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with(['user', 'campaign', 'organization']);

        // Filters
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->input('start_date') . ' 00:00:00', $request->input('end_date') . ' 23:59:59']);
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }
        if ($request->filled('organization_id')) {
            $query->where('organization_id', $request->input('organization_id'));
        }
        if ($request->filled('campaign_id')) {
            $query->where('campaign_id', $request->input('campaign_id'));
        }
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $donations = $query->latest()->paginate(15)->withQueryString();

        $users = User::whereIn('role', ['donor', 'user'])->get();
        $campaigns = Campaign::all();
        $organizations = Organization::all();

        return view('admin.donations.index', compact('donations', 'users', 'campaigns', 'organizations'));
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    public function updateStatus(Request $request, Donation $donation)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed,refunded',
        ]);

        $oldStatus = $donation->status;
        $newStatus = $request->input('status');
        
        $donation->status = $newStatus;
        $donation->save();

        // If donation completes, update campaign raised_amount
        if ($newStatus === 'completed' && $oldStatus !== 'completed' && $donation->campaign) {
            $donation->campaign->increment('raised_amount', $donation->amount);
        } elseif ($oldStatus === 'completed' && $newStatus !== 'completed' && $donation->campaign) {
            $donation->campaign->decrement('raised_amount', $donation->amount);
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'donations',
            'description' => "Updated status of transaction {$donation->transaction_id} from {$oldStatus} to {$newStatus}.",
        ]);

        return back()->with('success', 'Donation status updated successfully.');
    }

    public function export(Request $request)
    {
        $donations = Donation::with(['user', 'campaign', 'organization'])->latest()->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=donations_export_" . date('Ymd') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Transaction ID', 'Donor', 'Organization', 'Campaign', 'Amount', 'Type', 'Status', 'Payment Method', 'Date']);

            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->transaction_id,
                    $donation->user ? $donation->user->name : ($donation->is_anonymous ? 'Anonymous' : 'Guest'),
                    $donation->organization ? $donation->organization->name : 'N/A',
                    $donation->campaign ? $donation->campaign->title : 'N/A',
                    $donation->amount,
                    $donation->type,
                    $donation->status,
                    $donation->payment_method,
                    $donation->created_at->toDateTimeString()
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
