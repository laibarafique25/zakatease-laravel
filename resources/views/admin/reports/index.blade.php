@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Reports</li>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Reports & Analytics</h1>
    <p class="page-subtitle">Platform overview covering donations, users, campaigns, and prayer logs.</p>
  </div>

  <div class="card-grid mb-4">
    <div class="admin-card">
      <div class="card-header-flex">
        <span class="card-title-muted">Total Zakat</span>
        <div class="card-icon-box accent">💰</div>
      </div>
      <div class="card-value">PKR {{ number_format($zakatSum) }}</div>
    </div>
    
    <div class="admin-card">
      <div class="card-header-flex">
        <span class="card-title-muted">Total Sadaqah</span>
        <div class="card-icon-box accent">💸</div>
      </div>
      <div class="card-value">PKR {{ number_format($sadaqaSum) }}</div>
    </div>
    
    <div class="admin-card">
      <div class="card-header-flex">
        <span class="card-title-muted">General Fund</span>
        <div class="card-icon-box accent">🏦</div>
      </div>
      <div class="card-value">PKR {{ number_format($generalSum) }}</div>
    </div>
    
    <div class="admin-card">
      <div class="card-header-flex">
        <span class="card-title-muted">Emergency Fund</span>
        <div class="card-icon-box accent">🚨</div>
      </div>
      <div class="card-value">PKR {{ number_format($emergencySum) }}</div>
    </div>
  </div>

  <div class="card-grid">
    <!-- User Roles -->
    <div class="admin-card" style="grid-column: span 1;">
      <h3 class="card-title mb-3">Users by Role</h3>
      <ul class="list-group" style="list-style: none; padding: 0; margin: 0;">
        @foreach($rolesCount as $role)
          <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border);">
            <span style="text-transform: capitalize;">{{ $role->role }}</span>
            <span class="badge badge-primary">{{ $role->total }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    <!-- Prayer Stats -->
    <div class="admin-card" style="grid-column: span 1;">
      <h3 class="card-title mb-3">Prayer Statistics</h3>
      <ul class="list-group" style="list-style: none; padding: 0; margin: 0;">
        <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border);">
          <span>Prayed On Time / Jamaat</span>
          <span class="badge badge-success">{{ $prayedOnTime }}</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border);">
          <span>Prayed Late</span>
          <span class="badge badge-warning">{{ $prayedLate }}</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border);">
          <span>Qaza Prayers</span>
          <span class="badge badge-danger">{{ $qazaPrayers }}</span>
        </li>
        <li style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border);">
          <strong>Total Prayers Logged</strong>
          <strong>{{ $totalPrayers }}</strong>
        </li>
      </ul>
    </div>

    <!-- Top Campaigns -->
    <div class="admin-card" style="grid-column: span 2;">
      <h3 class="card-title mb-3">Top Campaigns</h3>
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Campaign Name</th>
              <th>Goal</th>
              <th>Raised</th>
              <th>Progress</th>
            </tr>
          </thead>
          <tbody>
            @foreach($topCampaigns as $campaign)
              <tr>
                <td><strong>{{ $campaign->title }}</strong></td>
                <td>PKR {{ number_format($campaign->goal_amount) }}</td>
                <td>PKR {{ number_format($campaign->raised_amount) }}</td>
                <td>
                  <div class="bar-chart-wrapper" style="width:100%;height:8px;background:var(--border);border-radius:4px;overflow:hidden;">
                    <div class="bar-chart-fill" style="width:{{ min(100, ($campaign->raised_amount / max(1, $campaign->goal_amount)) * 100) }}%;background:var(--emerald);height:100%;"></div>
                  </div>
                </td>
              </tr>
            @endforeach
            @if($topCampaigns->isEmpty())
              <tr><td colspan="4" class="text-center">No campaigns found.</td></tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <a href="{{ route('admin.reports.export', ['type' => 'donations']) }}" class="btn btn-primary">⬇️ Export Donations (CSV)</a>
    <a href="{{ route('admin.reports.export', ['type' => 'users']) }}" class="btn btn-secondary">⬇️ Export Users (CSV)</a>
  </div>
@endsection
