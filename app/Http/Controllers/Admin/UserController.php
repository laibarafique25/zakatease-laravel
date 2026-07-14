<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('verification')) {
            $query->where('is_verified', $request->input('verification') === 'verified');
        }

        // Sort
        $sortColumn = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');
        $query->orderBy($sortColumn, $sortDirection);

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['donorProfile', 'receiverProfile', 'organization']);
        $activities = ActivityLog::where('user_id', $user->id)->latest()->limit(10)->get();
        return view('admin.users.show', compact('user', 'activities'));
    }

    public function approveUser(User $user)
    {
        $user->status = 'active';
        $user->is_verified = true;
        $user->trust_score = max($user->trust_score, 50);
        $user->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'approve',
            'module' => 'users',
            'description' => "Approved and verified user account {$user->email}.",
        ]);

        // Send approval email silently (won't crash if mail not configured)
        try {
            Mail::raw(
                "Dear {$user->name},\n\nCongratulations! Your account on ZARIYAH has been approved and verified.\n\nYou can now log in and access all features.\n\nBlessings,\nZARIYAH Team",
                function ($message) use ($user) {
                    $message->to($user->email)->subject('Your Account Has Been Approved - ZARIYAH');
                }
            );
        } catch (\Exception $e) {}

        return back()->with('success', "User {$user->name} has been approved and verified.");
    }

    public function rejectUser(Request $request, User $user)
    {
        $user->status = 'inactive';
        $user->is_verified = false;
        $user->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'reject',
            'module' => 'users',
            'description' => "Rejected user account {$user->email}. Reason: " . ($request->reason ?? 'N/A'),
        ]);

        try {
            Mail::raw(
                "Dear {$user->name},\n\nWe regret to inform you that your account application was not approved at this time.\n\nReason: " . ($request->reason ?? 'Your documents could not be verified.') . "\n\nIf you believe this is a mistake, please contact support.\n\nBlessings,\nZARIYAH Team",
                function ($message) use ($user) {
                    $message->to($user->email)->subject('Account Application Update - ZARIYAH');
                }
            );
        } catch (\Exception $e) {}

        return back()->with('success', "User {$user->name} has been rejected.");
    }

    public function addNote(Request $request, User $user)
    {
        $request->validate(['note' => 'required|string|max:1000']);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'note',
            'module' => 'users',
            'description' => "Admin note for {$user->email}: " . $request->note,
        ]);

        return back()->with('success', 'Note added successfully.');
    }

    public function updateTrustScore(Request $request, User $user)
    {
        $request->validate(['trust_score' => 'required|integer|min:0|max:100']);

        $user->trust_score = $request->trust_score;
        $user->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'users',
            'description' => "Updated trust score for {$user->email} to {$request->trust_score}.",
        ]);

        return back()->with('success', 'Trust score updated.');
    }

    public function suspendUser(User $user)
    {
        $user->status = 'inactive';
        $user->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'suspend',
            'module' => 'users',
            'description' => "Suspended user account {$user->email}.",
        ]);

        return back()->with('success', "User {$user->name} has been suspended.");
    }

    public function blockUser(User $user)
    {
        $user->status = 'banned';
        $user->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'block',
            'module' => 'users',
            'description' => "Blocked user account {$user->email}.",
        ]);

        return back()->with('success', "User {$user->name} has been blocked.");
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:super_admin,admin,organization,donor,receiver,user',
            'status' => 'required|in:active,inactive,banned',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'status' => $data['status'],
            'phone' => $data['phone'],
            'is_verified' => true,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'users',
            'description' => "Created user account for {$user->email}.",
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:super_admin,admin,organization,donor,receiver,user',
            'status' => 'required|in:active,inactive,banned',
            'phone' => 'nullable|string|max:20',
            'trust_score' => 'nullable|integer|min:0|max:100',
        ]);

        $oldValues = $user->only(['name', 'email', 'role', 'status', 'phone', 'trust_score']);

        $user->update($data);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'users',
            'description' => "Updated user account {$user->email}.",
            'old_values' => $oldValues,
            'new_values' => $data,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $email = $user->email;
        $user->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'users',
            'description' => "Deleted user account {$email}.",
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'No users selected.');
        }

        // Avoid deleting self
        $ids = array_filter($ids, fn($id) => (int)$id !== (int)auth()->id());
        
        User::whereIn('id', $ids)->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'users',
            'description' => "Bulk deleted users: " . implode(', ', $ids),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Selected users deleted successfully.');
    }

    public function toggleVerification(User $user)
    {
        $user->is_verified = !$user->is_verified;
        $user->verified_at = $user->is_verified ? now() : null;
        $user->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'users',
            'description' => "Toggled verification status for {$user->email} to " . ($user->is_verified ? 'Verified' : 'Unverified'),
        ]);

        return back()->with('success', 'User verification updated.');
    }

    public function toggleStatus(User $user)
    {
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'users',
            'description' => "Toggled status for {$user->email} to {$user->status}.",
        ]);

        return back()->with('success', 'User status updated.');
    }

    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $users = User::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users_export_" . date('Ymd') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Role', 'Status', 'Phone', 'Verified', 'Trust Score', 'Created Date']);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->role,
                    $user->status,
                    $user->phone,
                    $user->is_verified ? 'Yes' : 'No',
                    $user->trust_score,
                    $user->created_at->toDateString()
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
