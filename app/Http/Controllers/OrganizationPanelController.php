<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrganizationPanelController extends Controller
{
    protected function getOrganization()
    {
        $org = Organization::where('user_id', Auth::id())->first();
        if (!$org) {
            // Auto create organization record for organization users if it doesn't exist
            $org = Organization::create([
                'user_id' => Auth::id(),
                'name' => Auth::user()->name,
                'slug' => Str::slug(Auth::user()->name),
                'status' => 'pending',
            ]);
        }
        return $org;
    }

    public function dashboard()
    {
        $org = $this->getOrganization();
        
        $campaignCount = Campaign::where('organization_id', $org->id)->count();
        $totalRaised = Campaign::where('organization_id', $org->id)->sum('raised_amount') ?? 0;
        $donationCount = Donation::where('organization_id', $org->id)->count();
        
        $recentDonations = Donation::with('campaign', 'user')
            ->where('organization_id', $org->id)
            ->latest()
            ->limit(5)
            ->get();

        $recentCampaigns = Campaign::where('organization_id', $org->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('organization.dashboard', compact('org', 'campaignCount', 'totalRaised', 'donationCount', 'recentDonations', 'recentCampaigns'));
    }

    public function campaigns()
    {
        $org = $this->getOrganization();
        $campaigns = Campaign::where('organization_id', $org->id)
            ->latest()
            ->paginate(10);

        return view('organization.campaigns', compact('campaigns'));
    }

    public function createCampaign(Request $request)
    {
        $org = $this->getOrganization();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:1',
            'type' => 'required|string|in:zakat,sadaqa,general,emergency',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        Campaign::create([
            'organization_id' => $org->id,
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . rand(1000, 9999),
            'description' => $data['description'],
            'goal_amount' => $data['goal_amount'],
            'raised_amount' => 0,
            'type' => $data['type'],
            'status' => 'pending', // Requires admin review
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return back()->with('success', 'Campaign created successfully. It will be live once approved by Admin.');
    }

    public function donations()
    {
        $org = $this->getOrganization();
        $donations = Donation::with('campaign', 'user')
            ->where('organization_id', $org->id)
            ->latest()
            ->paginate(10);

        return view('organization.donations', compact('donations'));
    }

    public function reports()
    {
        $org = $this->getOrganization();
        $donations = Donation::with('campaign', 'user')
            ->where('organization_id', $org->id)
            ->latest()
            ->get();

        $campaigns = Campaign::where('organization_id', $org->id)->get();

        return view('organization.reports', compact('donations', 'campaigns'));
    }
}
