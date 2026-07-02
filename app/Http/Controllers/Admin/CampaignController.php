<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Organization;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::with('organization');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $campaigns = $query->latest()->paginate(15)->withQueryString();

        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $donations = $campaign->donations()->with('user')->latest()->paginate(10);
        return view('admin.campaigns.show', compact('campaign', 'donations'));
    }

    public function create()
    {
        $organizations = Organization::where('status', 'approved')->get();
        return view('admin.campaigns.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:1',
            'type' => 'required|in:zakat,sadaqa,general,emergency',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . rand(100, 999);
        $data['raised_amount'] = 0;
        $data['status'] = 'approved';
        $data['user_id'] = Organization::find($data['organization_id'])->user_id;

        $campaign = Campaign::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'campaigns',
            'description' => "Created campaign: {$campaign->title}.",
        ]);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created successfully.');
    }

    public function edit(Campaign $campaign)
    {
        $organizations = Organization::where('status', 'approved')->get();
        return view('admin.campaigns.edit', compact('campaign', 'organizations'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:1',
            'type' => 'required|in:zakat,sadaqa,general,emergency',
            'status' => 'required|in:draft,pending,approved,rejected,completed,suspended',
            'rejection_reason' => 'nullable|required_if:status,rejected|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $oldValues = $campaign->only(['title', 'description', 'goal_amount', 'type', 'status']);
        $campaign->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'campaigns',
            'description' => "Updated campaign: {$campaign->title}.",
            'old_values' => $oldValues,
            'new_values' => $data,
        ]);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign updated successfully.');
    }

    public function destroy(Campaign $campaign)
    {
        $title = $campaign->title;
        $campaign->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'campaigns',
            'description' => "Deleted campaign: {$title}.",
        ]);

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign deleted successfully.');
    }

    public function toggleFeatured(Campaign $campaign)
    {
        $campaign->is_featured = !$campaign->is_featured;
        $campaign->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'campaigns',
            'description' => "Toggled featured status of campaign {$campaign->title} to " . ($campaign->is_featured ? 'Featured' : 'Regular'),
        ]);

        return back()->with('success', 'Campaign featured status updated.');
    }

    public function toggleUrgent(Campaign $campaign)
    {
        $campaign->is_urgent = !$campaign->is_urgent;
        $campaign->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'campaigns',
            'description' => "Toggled urgent status of campaign {$campaign->title} to " . ($campaign->is_urgent ? 'Urgent' : 'Regular'),
        ]);

        return back()->with('success', 'Campaign urgent status updated.');
    }

    public function approve(Campaign $campaign)
    {
        $campaign->status = 'approved';
        $campaign->rejection_reason = null;
        $campaign->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'campaigns',
            'description' => "Approved campaign: {$campaign->title}.",
        ]);

        return back()->with('success', 'Campaign approved successfully.');
    }

    public function reject(Request $request, Campaign $campaign)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $campaign->status = 'rejected';
        $campaign->rejection_reason = $request->input('rejection_reason');
        $campaign->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'campaigns',
            'description' => "Rejected campaign {$campaign->title} for reason: " . $request->input('rejection_reason'),
        ]);

        return back()->with('success', 'Campaign rejected.');
    }
}
