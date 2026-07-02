@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
  <li class="active">View Details</li>
@endsection

@section('actions')
  <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-primary btn-sm">✏️ Edit Campaign</a>
@endsection

@section('content')
  <div class="form-card" style="max-width: 900px">
    <div class="profile-card-header">
      <div class="profile-card-avatar" style="border-radius: 12px; font-size: 1.5rem">
        📢
      </div>
      <div>
        <h2>{{ $campaign->title }}</h2>
        <span class="badge badge-info" style="margin-top: 4px">{{ $campaign->type }}</span>
        <span class="badge badge-{{ $campaign->status === 'approved' ? 'success' : ($campaign->status === 'pending' ? 'warning' : 'danger') }}">{{ $campaign->status }}</span>
      </div>
    </div>

    @php
      $pct = $campaign->goal_amount > 0 ? min(round(($campaign->raised_amount / $campaign->goal_amount) * 100), 100) : 0;
    @endphp

    <div style="background: var(--bg); border: 1px solid var(--border); padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem">
      <h4 style="margin-bottom: 8px">Funding Progress</h4>
      <div class="bar-chart-wrapper" style="height: 16px; margin-bottom: 8px; background: var(--border)">
        <div class="bar-chart-fill" style="width: {{ $pct }}%"></div>
      </div>
      <div style="display:flex; justify-content: space-between; font-size: 0.9rem; font-weight: 600">
        <span>PKR {{ number_format($campaign->raised_amount) }} Raised</span>
        <span>{{ $pct }}% of PKR {{ number_format($campaign->goal_amount) }} Target</span>
      </div>
    </div>

    <div class="profile-details-grid" style="margin-bottom: 2rem">
      <div class="profile-detail-item">
        <span class="label">Partner Organization</span>
        <span class="val">
          @if($campaign->organization)
            <a href="{{ route('admin.organizations.show', $campaign->organization->id) }}" style="color:var(--accent)">{{ $campaign->organization->name }}</a>
          @else
            N/A
          @endif
        </span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Date Range</span>
        <span class="val">
          {{ $campaign->start_date ? $campaign->start_date->format('M d, Y') : 'Start Immediately' }} - 
          {{ $campaign->end_date ? $campaign->end_date->format('M d, Y') : 'End on target' }}
        </span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Urgent Priority</span>
        <span class="val">{{ $campaign->is_urgent ? 'Yes' : 'No' }}</span>
      </div>
      <div class="profile-detail-item">
        <span class="label">Featured on Web</span>
        <span class="val">{{ $campaign->is_featured ? 'Yes' : 'No' }}</span>
      </div>
    </div>

    @if($campaign->description)
      <div style="margin-bottom: 2rem">
        <span class="label" style="font-size: 0.75rem; text-transform: uppercase; color: var(--muted); font-weight: 600;">Description & Proposals</span>
        <p style="margin-top: 6px; font-size: 0.95rem; line-height: 1.7; color: var(--text)">{{ $campaign->description }}</p>
      </div>
    @endif

    <hr style="border-color: var(--border); margin-bottom: 1.5rem">

    <h3>Transaction Analytics</h3>
    <div class="table-card" style="margin-top: 1rem; border-color: var(--border)">
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Txn ID</th>
              <th>Donor</th>
              <th>Amount</th>
              <th>Payment Method</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse($donations as $donation)
              <tr>
                <td class="bold">{{ $donation->transaction_id }}</td>
                <td>{{ $donation->user ? $donation->user->name : ($donation->is_anonymous ? 'Anonymous' : 'Guest') }}</td>
                <td>PKR {{ number_format($donation->amount) }}</td>
                <td>{{ $donation->payment_method ?? 'N/A' }}</td>
                <td>
                  <span class="badge badge-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'danger') }}">
                    {{ $donation->status }}
                  </span>
                </td>
                <td>{{ $donation->created_at->format('M d, Y H:i') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center" style="padding: 1rem">No donations recorded for this campaign yet.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
