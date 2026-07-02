<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $query = Organization::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('verification')) {
            $query->where('is_verified', $request->input('verification') === 'verified');
        }

        $organizations = $query->latest()->paginate(15)->withQueryString();

        return view('admin.organizations.index', compact('organizations'));
    }

    public function show(Organization $organization)
    {
        $campaigns = $organization->campaigns()->latest()->paginate(10);
        return view('admin.organizations.show', compact('organization', 'campaigns'));
    }

    public function create()
    {
        $usersWithoutOrg = User::where('role', 'organization')
            ->whereDoesntHave('organization')
            ->get();

        return view('admin.organizations.create', compact('usersWithoutOrg'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . rand(100, 999);
        $data['status'] = 'approved';
        $data['is_verified'] = true;

        $organization = Organization::create($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'organizations',
            'description' => "Created organization profile for {$organization->name}.",
        ]);

        return redirect()->route('admin.organizations.index')->with('success', 'Organization created successfully.');
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'status' => 'required|in:pending,approved,rejected,suspended',
            'rejection_reason' => 'nullable|required_if:status,rejected|string',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data['is_verified'] = $request->has('is_verified');
        $data['is_featured'] = $request->has('is_featured');

        $oldValues = $organization->only(['name', 'description', 'website', 'phone', 'status', 'is_verified']);

        $organization->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'organizations',
            'description' => "Updated organization profile for {$organization->name}.",
            'old_values' => $oldValues,
            'new_values' => $data,
        ]);

        return redirect()->route('admin.organizations.index')->with('success', 'Organization updated successfully.');
    }

    public function destroy(Organization $organization)
    {
        $name = $organization->name;
        $organization->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'organizations',
            'description' => "Deleted organization profile: {$name}.",
        ]);

        return redirect()->route('admin.organizations.index')->with('success', 'Organization deleted successfully.');
    }

    public function approve(Organization $organization)
    {
        $organization->status = 'approved';
        $organization->is_verified = true;
        $organization->rejection_reason = null;
        $organization->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'organizations',
            'description' => "Approved organization {$organization->name}.",
        ]);

        return back()->with('success', 'Organization approved and verified.');
    }

    public function reject(Request $request, Organization $organization)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $organization->status = 'rejected';
        $organization->is_verified = false;
        $organization->rejection_reason = $request->input('rejection_reason');
        $organization->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'organizations',
            'description' => "Rejected organization {$organization->name} for reason: " . $request->input('rejection_reason'),
        ]);

        return back()->with('success', 'Organization rejected successfully.');
    }
}
