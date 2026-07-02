@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.organizations.index') }}">Organizations</a></li>
  <li class="active">View Profile</li>
@endsection

@section('actions')
  <a href="{{ route('admin.organizations.edit', $organization->id) }}" class="btn btn-primary btn-sm">✏️ Edit Profile</a>
@endsection

@section('content')
  <div class="form-card" style="max-width: 900px">
    <div class="profile-card-header">
      <div class="profile-card-avatar" style="border-radius: 12px; font-size: 1.5rem">
        🏢
      </div>
      <div>
        <h2>{{ $organization->name }}</h2>
        <span class="badge badge-info" style="margin-top: 4px">{{ $organization->status }}</span>
        <span class="badge badge-{{ $organization->is_verified ? 'success' : 'warning' }}">{{ $organization->is_verified ? 'Verified Partner' : 'Unverified' }}</span>
      </div>
    </div>

    <div class="profile-details-grid" style="margin-bottom: 2rem">
      <div class="profile-detail-item">
        <span class="label">Website</span>
        <span class="val">
          @if($organization->website)
            <a href="{{ $organization->website }}" target="_blank" style="color:var(--accent)">{{ $organization->website }}</a>
          @else
            N/A
          @endif
        </span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Public Email</span>
        <span class="val">{{ $organization->email ?? 'N/A' }}</span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Contact Phone</span>
        <span class="val">{{ $organization->phone ?? 'N/A' }}</span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Location</span>
        <span class="val">{{ $organization->address ?? '' }}, {{ $organization->city }}, {{ $organization->country }}</span>
      </div>
    </div>

    @if($organization->description)
      <div style="margin-bottom: 2rem">
        <span class="label" style="font-size: 0.75rem; text-transform: uppercase; color: var(--muted); font-weight: 600;">Description</span>
        <p style="margin-top: 6px; font-size: 0.95rem; line-height: 1.7; color: var(--text)">{{ $organization->description }}</p>
      </div>
    @endif

    @if($organization->status === 'rejected' && $organization->rejection_reason)
      <div style="background: var(--danger-light); border: 1px solid var(--danger); padding: 1rem; border-radius: 12px; margin-bottom: 2rem">
        <h4 style="color: var(--danger); margin-bottom: 4px">Rejection Notes</h4>
        <p style="font-size: 0.9rem">{{ $organization->rejection_reason }}</p>
      </div>
    @endif

    <hr style="border-color: var(--border); margin-bottom: 1.5rem">

    <h3>Linked Campaigns</h3>
    <div class="table-card" style="margin-top: 1rem; border-color: var(--border)">
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Goal</th>
              <th>Raised</th>
              <th>Type</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($campaigns as $camp)
              <tr>
                <td class="bold">
                  <a href="{{ route('admin.campaigns.show', $camp->id) }}" style="text-decoration:none; color:var(--text)">{{ $camp->title }}</a>
                </td>
                <td>PKR {{ number_format($camp->goal_amount) }}</td>
                <td>PKR {{ number_format($camp->raised_amount) }}</td>
                <td><span class="badge badge-info">{{ $camp->type }}</span></td>
                <td>
                  <span class="badge badge-{{ $camp->status === 'approved' ? 'success' : ($camp->status === 'pending' ? 'warning' : 'danger') }}">
                    {{ $camp->status }}
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center" style="padding: 1rem">No campaigns created by this organization yet.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
