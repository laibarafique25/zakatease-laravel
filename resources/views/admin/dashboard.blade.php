@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Dashboard</li>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Assalamu Alaikum, {{ auth()->user()->name }}</h1>
    <p class="page-subtitle">Welcome to your ZARIYAH platform workspace. Here is an overview of the system today.</p>
  </div>

  <!-- STATS CARDS GRID -->
  <div class="card-grid">
    <div class="admin-card">
      <div class="card-header-flex">
        <span class="card-title-muted">Total Users</span>
        <div class="card-icon-box accent">👥</div>
      </div>
      <div class="card-value">{{ number_format($totalUsers) }}</div>
      <div class="card-trend up">
        <span>▲</span> {{ number_format($activeUsers) }} active users
      </div>
    </div>

    <div class="admin-card">
      <div class="card-header-flex">
        <span class="card-title-muted">Total Donations</span>
        <div class="card-icon-box success">🪙</div>
      </div>
      <div class="card-value">PKR {{ number_format($totalDonations, 0) }}</div>
      <div class="card-trend {{ $growthPct >= 0 ? 'up' : 'down' }}">
        <span>{{ $growthPct >= 0 ? '▲' : '▼' }}</span> {{ abs($growthPct) }}% growth vs last month
      </div>
    </div>

    <div class="admin-card">
      <div class="card-header-flex">
        <span class="card-title-muted">Zakat Collected</span>
        <div class="card-icon-box success">🧮</div>
      </div>
      <div class="card-value">PKR {{ number_format($totalZakatCollected, 0) }}</div>
      <div class="card-trend up">
        <span>✦</span> Purified & verified wealth
      </div>
    </div>

    <div class="admin-card">
      <div class="card-header-flex">
        <span class="card-title-muted">Active Campaigns</span>
        <div class="card-icon-box warning">📢</div>
      </div>
      <div class="card-value">{{ $totalCampaigns }}</div>
      <div class="card-trend up">
        <span>★</span> {{ $totalOrganizations }} Partner Orgs
      </div>
    </div>
  </div>

  <!-- SECONDARY INSIGHTS GRID -->
  <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-bottom: 2rem;">
    <div class="admin-card" style="padding: 1.25rem;">
      <span class="card-title-muted" style="font-size: 0.75rem;">Avg Prayers Logged</span>
      <div class="card-value" style="font-size: 1.4rem;">{{ $avgPrayersPerUser }} / user</div>
      <div class="activity-time">{{ $totalPrayersLogged }} total logs</div>
    </div>
    <div class="admin-card" style="padding: 1.25rem;">
      <span class="card-title-muted" style="font-size: 0.75rem;">Qaza Completed</span>
      <div class="card-value" style="font-size: 1.4rem;">{{ number_format($qazaPrayersLogged) }}</div>
      <div class="activity-time">Remembrance & correction logs</div>
    </div>
    <div class="admin-card" style="padding: 1.25rem;">
      <span class="card-title-muted" style="font-size: 0.75rem;">Azkar Reads</span>
      <div class="card-value" style="font-size: 1.4rem;">{{ number_format($azkarReads) }}</div>
      <div class="activity-time">Daily Tasbeeh counters</div>
    </div>
    <div class="admin-card" style="padding: 1.25rem;">
      <span class="card-title-muted" style="font-size: 0.75rem;">AI Assistant Queries</span>
      <div class="card-value" style="font-size: 1.4rem;">{{ number_format($aiUsage) }}</div>
      <div class="activity-time">Smart Fiqh search logs</div>
    </div>
  </div>

  <!-- DASHBOARD CHARTS & RECENT ACTIVITY SECTION -->
  <div class="dashboard-grid">
    
    <!-- LEFT COLUMN: CHARTS & LOGS -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem">
      
      <!-- Growth Graph simulation -->
      <div class="admin-card">
        <h3 style="margin-bottom: 1rem">Monthly Donation Split</h3>
        <p class="page-subtitle" style="margin-bottom: 1.5rem">Relative distribution of Zakat, Sadaqa, Emergency and General donations.</p>
        
        @php
          $totalAmount = $totalDonations ?: 1;
          // Query completed totals
          $zakatSumVal = \App\Models\Donation::where('status', 'completed')->where('type', 'zakat')->sum('amount');
          $sadaqaSumVal = \App\Models\Donation::where('status', 'completed')->where('type', 'sadaqa')->sum('amount');
          $emergencySumVal = \App\Models\Donation::where('status', 'completed')->where('type', 'emergency')->sum('amount');
          $generalSumVal = \App\Models\Donation::where('status', 'completed')->where('type', 'general')->sum('amount');

          $zakatPct = round(($zakatSumVal / $totalAmount) * 100);
          $sadaqaPct = round(($sadaqaSumVal / $totalAmount) * 100);
          $emergencyPct = round(($emergencySumVal / $totalAmount) * 100);
          $generalPct = round(($generalSumVal / $totalAmount) * 100);
        @endphp

        <div class="bar-chart-container">
          <div class="bar-chart-row">
            <span class="bar-chart-label">Zakat</span>
            <div class="bar-chart-wrapper">
              <div class="bar-chart-fill" style="width: {{ $zakatPct }}%; background: var(--accent)"></div>
            </div>
            <span class="bar-chart-value">{{ $zakatPct }}%</span>
          </div>

          <div class="bar-chart-row">
            <span class="bar-chart-label">Sadaqa</span>
            <div class="bar-chart-wrapper">
              <div class="bar-chart-fill" style="width: {{ $sadaqaPct }}%; background: var(--accent-secondary)"></div>
            </div>
            <span class="bar-chart-value">{{ $sadaqaPct }}%</span>
          </div>

          <div class="bar-chart-row">
            <span class="bar-chart-label">Emergency Aid</span>
            <div class="bar-chart-wrapper">
              <div class="bar-chart-fill" style="width: {{ $emergencyPct }}%; background: var(--danger)"></div>
            </div>
            <span class="bar-chart-value">{{ $emergencyPct }}%</span>
          </div>

          <div class="bar-chart-row">
            <span class="bar-chart-label">General</span>
            <div class="bar-chart-wrapper">
              <div class="bar-chart-fill" style="width: {{ $generalPct }}%; background: var(--muted)"></div>
            </div>
            <span class="bar-chart-value">{{ $generalPct }}%</span>
          </div>
        </div>
      </div>

      <!-- Recent Donations Table -->
      <div class="table-card">
        <div class="table-header">
          <h3>Latest Donations</h3>
          <a href="{{ url('/admin/donations') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="table-responsive">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Txn ID</th>
                <th>Donor</th>
                <th>Campaign</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentDonations as $donation)
                <tr>
                  <td class="bold">{{ $donation->transaction_id }}</td>
                  <td>{{ $donation->user ? $donation->user->name : ($donation->is_anonymous ? 'Anonymous' : 'Guest') }}</td>
                  <td>{{ $donation->campaign ? Str::limit($donation->campaign->title, 25) : 'General' }}</td>
                  <td>PKR {{ number_format($donation->amount) }}</td>
                  <td>
                    <span class="badge badge-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'danger') }}">
                      {{ $donation->status }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center">No donations logged yet.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- RIGHT COLUMN: SYSTEM ENVIRONMENT & ACTIVITIES -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem">
      
      <!-- System Health Card -->
      <div class="admin-card">
        <h3 style="margin-bottom: 1rem">System Health</h3>
        <ul class="activity-list">
          <li class="activity-item" style="padding: 0.5rem 0">
            <div class="activity-dot success"></div>
            <div class="activity-info">
              <div class="bold" style="font-size: 0.85rem">Database Status</div>
              <div class="activity-time">{{ $health['db_connection'] }}</div>
            </div>
          </li>
          <li class="activity-item" style="padding: 0.5rem 0">
            <div class="activity-dot success"></div>
            <div class="activity-info">
              <div class="bold" style="font-size: 0.85rem">PHP Version</div>
              <div class="activity-time">{{ $health['php_version'] }}</div>
            </div>
          </li>
          <li class="activity-item" style="padding: 0.5rem 0">
            <div class="activity-dot success"></div>
            <div class="activity-info">
              <div class="bold" style="font-size: 0.85rem">Server Load</div>
              <div class="activity-time">{{ $health['server_load'] }}</div>
            </div>
          </li>
        </ul>
      </div>

      <!-- Recent Audit Logs -->
      <div class="admin-card">
        <h3 style="margin-bottom: 1rem">Admin Activity Logs</h3>
        <ul class="activity-list">
          @forelse($activityLogs as $log)
            <li class="activity-item">
              <div class="activity-dot {{ $log->action === 'delete' ? 'danger' : ($log->action === 'create' ? 'success' : 'warning') }}"></div>
              <div class="activity-info">
                <span class="bold" style="font-size: 0.85rem;">{{ $log->user ? $log->user->name : 'System' }}</span>
                <span style="font-size: 0.85rem;">{{ $log->description }}</span>
                <div class="activity-time">{{ $log->created_at->diffForHumans() }}</div>
              </div>
            </li>
          @empty
            <li class="text-center" style="font-size: 0.85rem; color: var(--muted); padding: 1rem 0">No recent actions logged.</li>
          @endforelse
        </ul>
      </div>

      <!-- Recent Registrations -->
      <div class="admin-card">
        <h3 style="margin-bottom: 1rem">Recent Registrations</h3>
        <ul class="activity-list">
          @forelse($recentUsers as $user)
            <li class="activity-item" style="padding: 0.5rem 0">
              <div class="profile-avatar" style="width: 28px; height: 28px; font-size: 0.75rem; border-width: 1px">
                {{ strtoupper(substr($user->name, 0, 1)) }}
              </div>
              <div class="activity-info">
                <div class="bold" style="font-size: 0.85rem">{{ $user->name }}</div>
                <div class="activity-time">{{ $user->email }} ({{ $user->role }})</div>
              </div>
            </li>
          @empty
            <li class="text-center" style="font-size: 0.85rem; color: var(--muted); padding: 1rem 0">No users found.</li>
          @endforelse
        </ul>
      </div>
    </div>

  </div>
@endsection
