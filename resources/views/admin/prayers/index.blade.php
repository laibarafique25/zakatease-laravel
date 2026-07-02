@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Prayer Management</li>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Prayer & Remembrance Settings</h1>
    <p class="page-subtitle">Configure prayer notification timings, update reminders templates, select Active API, and view streaks.</p>
  </div>

  <div class="dashboard-grid">
    <!-- LEFT COLUMN: SETTINGS FORM -->
    <div>
      <div class="form-card" style="margin:0 0 2rem 0; max-width: 100%">
        <h3 class="form-title">API & Calculation Configuration</h3>
        <form method="POST" action="{{ route('admin.prayers.settings.update') }}">
          @csrf
          
          <div class="form-group">
            <label for="prayer_api_url">Active Prayer API Base URL</label>
            <input type="text" id="prayer_api_url" name="prayer_api_url" class="form-control" value="{{ $settings['prayer_api_url'] }}" required>
          </div>

          <div class="form-group-grid">
            <div class="form-group">
              <label for="prayer_calculation_method">Calculation Method</label>
              <select id="prayer_calculation_method" name="prayer_calculation_method" class="form-control">
                <option value="1" {{ $settings['prayer_calculation_method'] == '1' ? 'selected' : '' }}>University of Islamic Sciences, Karachi</option>
                <option value="2" {{ $settings['prayer_calculation_method'] == '2' ? 'selected' : '' }}>Islamic Society of North America (ISNA)</option>
                <option value="3" {{ $settings['prayer_calculation_method'] == '3' ? 'selected' : '' }}>Muslim World League (MWL)</option>
                <option value="4" {{ $settings['prayer_calculation_method'] == '4' ? 'selected' : '' }}>Umm Al-Qura University, Makkah</option>
                <option value="5" {{ $settings['prayer_calculation_method'] == '5' ? 'selected' : '' }}>Egyptian General Authority of Survey</option>
              </select>
            </div>

            <div class="form-group">
              <label for="prayer_madhab">Asr Calculation (Madhab)</label>
              <select id="prayer_madhab" name="prayer_madhab" class="form-control">
                <option value="0" {{ $settings['prayer_madhab'] == '0' ? 'selected' : '' }}>Standard (Shafi, Maliki, Hanbali)</option>
                <option value="1" {{ $settings['prayer_madhab'] == '1' ? 'selected' : '' }}>Hanafi School</option>
              </select>
            </div>
          </div>

          <div class="form-group-grid">
            <div class="form-group">
              <label for="default_city">Default City</label>
              <input type="text" id="default_city" name="default_city" class="form-control" value="{{ $settings['default_city'] }}" required>
            </div>
            <div class="form-group">
              <label for="default_country">Default Country</label>
              <input type="text" id="default_country" name="default_country" class="form-control" value="{{ $settings['default_country'] }}" required>
            </div>
          </div>

          <div class="form-group-grid">
            <div class="form-group">
              <label for="before_prayer_minutes">Alert Interval (Minutes before prayer)</label>
              <input type="number" id="before_prayer_minutes" name="before_prayer_minutes" class="form-control" value="{{ $settings['before_prayer_minutes'] }}" required>
            </div>
            <div class="form-group">
              <label for="prayer_notifications_enabled">Push Notifications</label>
              <select id="prayer_notifications_enabled" name="prayer_notifications_enabled" class="form-control">
                <option value="true" {{ $settings['prayer_notifications_enabled'] == 'true' ? 'selected' : '' }}>Enabled</option>
                <option value="false" {{ $settings['prayer_notifications_enabled'] == 'false' ? 'selected' : '' }}>Disabled</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="reminder_template_fajr">Fajr Specific Reminder Template</label>
            <textarea id="reminder_template_fajr" name="reminder_template_fajr" class="form-control" required>{{ $settings['reminder_template_fajr'] }}</textarea>
          </div>

          <div class="form-group">
            <label for="reminder_template_general">General Adhan Reminder Template</label>
            <textarea id="reminder_template_general" name="reminder_template_general" class="form-control" required>{{ $settings['reminder_template_general'] }}</textarea>
          </div>

          <div style="display:flex; justify-content: flex-end; margin-top: 1.5rem">
            <button type="submit" class="btn btn-primary">Save Settings</button>
          </div>
        </form>
      </div>

      <!-- Prayer logs Table -->
      <div class="table-card">
        <div class="table-header">
          <h3>Recent Prayer Logs</h3>
        </div>
        <div class="table-responsive">
          <table class="admin-table">
            <thead>
              <tr>
                <th>User</th>
                <th>Prayer</th>
                <th>Status</th>
                <th>Location</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentLogs as $log)
                <tr>
                  <td class="bold">{{ $log->user ? $log->user->name : 'Guest' }}</td>
                  <td>{{ $log->prayer_name }}</td>
                  <td>
                    <span class="badge badge-{{ $log->status === 'prayed' || $log->status === 'jamaat' ? 'success' : ($log->status === 'late' ? 'warning' : 'danger') }}">
                      {{ $log->status }}
                    </span>
                  </td>
                  <td>{{ $log->city }}, {{ $log->country }}</td>
                  <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center" style="padding:1rem">No prayer logging records.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="pagination-wrapper">
          {{ $recentLogs->links() }}
        </div>
      </div>
    </div>

    <!-- RIGHT COLUMN: STATS AND STREAKS -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem">
      <!-- Qaza Stats -->
      <div class="admin-card">
        <h3>Qaza Tracker Statistics</h3>
        <p class="page-subtitle" style="margin-bottom:1rem">Aggregation of outstanding and fulfilled prayers.</p>
        <div class="bar-chart-container">
          @forelse($qazaStats as $stat)
            <div class="bar-chart-row">
              <span class="bar-chart-label">{{ $stat->prayer_name }}</span>
              <div class="bar-chart-wrapper">
                @php
                  $total = $stat->completed + $stat->remaining;
                  $pct = $total > 0 ? round(($stat->completed / $total) * 100) : 0;
                @endphp
                <div class="bar-chart-fill" style="width: {{ $pct }}%"></div>
              </div>
              <span class="bar-chart-value">{{ $stat->completed }}/{{ $stat->completed + $stat->remaining }}</span>
            </div>
          @empty
            <p class="text-center" style="font-size:0.85rem; color:var(--muted)">No Qaza tracker logs recorded.</p>
          @endforelse
        </div>
      </div>

      <!-- Streaks Rankings -->
      <div class="admin-card">
        <h3>Top Prayer Streaks</h3>
        <ul class="activity-list">
          @forelse($streaks as $str)
            <li class="activity-item" style="padding:0.5rem 0">
              <div class="profile-avatar" style="width:30px; height:30px; font-size:0.75rem; border-width: 1px">
                {{ strtoupper(substr($str->user->name, 0, 1)) }}
              </div>
              <div class="activity-info">
                <div class="bold" style="font-size:0.85rem">{{ $str->user->name }}</div>
                <div class="activity-time">Daily: <span style="color:var(--accent); font-weight:700">{{ $str->daily_streak }} days</span> | Max: {{ $str->monthly_streak }} days</div>
              </div>
            </li>
          @empty
            <li class="text-center" style="font-size:0.85rem; color:var(--muted); padding:1rem 0">No active streaks. Log prayers to establish streaks!</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
@endsection
