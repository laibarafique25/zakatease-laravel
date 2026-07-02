@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.users.index') }}">Users</a></li>
  <li class="active">View Profile</li>
@endsection

@section('actions')
  <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">✏️ Edit Profile</a>
@endsection

@section('content')
  <div class="form-card" style="max-width: 900px">
    <div class="profile-card-header">
      <div class="profile-card-avatar">
        {{ strtoupper(substr($user->name, 0, 1)) }}
      </div>
      <div>
        <h2>{{ $user->name }}</h2>
        <span class="badge badge-info" style="margin-top: 4px">{{ $user->role }}</span>
        <span class="badge badge-{{ $user->status === 'active' ? 'success' : 'danger' }}">{{ $user->status }}</span>
      </div>
    </div>

    <div class="profile-details-grid" style="margin-bottom: 2rem">
      <div class="profile-detail-item">
        <span class="label">Email Address</span>
        <span class="val">{{ $user->email }}</span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Phone Number</span>
        <span class="val">{{ $user->phone ?? 'N/A' }}</span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Trust Score</span>
        <span class="val">{{ $user->trust_score }}%</span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Verification Status</span>
        <span class="val">{{ $user->is_verified ? 'Verified' : 'Not Verified' }}</span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Preferred Theme</span>
        <span class="val" style="text-transform: capitalize">{{ $user->theme }}</span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Member Since</span>
        <span class="val">{{ $user->created_at->format('M d, Y H:i') }}</span>
      </div>
    </div>

    <hr style="border-color: var(--border); margin-bottom: 1.5rem">

    <h3>Recent Actions Log</h3>
    <ul class="activity-list" style="margin-top: 1rem">
      @forelse($activities as $log)
        <li class="activity-item">
          <div class="activity-dot {{ $log->action === 'delete' ? 'danger' : ($log->action === 'create' ? 'success' : 'warning') }}"></div>
          <div class="activity-info">
            <span class="bold" style="font-size: 0.85rem">{{ $log->action }}</span>
            <span style="font-size: 0.85rem">{{ $log->description }}</span>
            <div class="activity-time">{{ $log->created_at->diffForHumans() }} (IP: {{ $log->ip_address }})</div>
          </div>
        </li>
      @empty
        <li style="font-size: 0.85rem; color: var(--muted); padding: 1rem 0" class="text-center">No actions logged for this user.</li>
      @endforelse
    </ul>
  </div>
@endsection
