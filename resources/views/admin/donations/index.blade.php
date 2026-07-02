@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Donations</li>
@endsection

@section('actions')
  <a href="{{ route('admin.donations.export') }}" class="btn btn-secondary btn-sm">📥 Export CSV</a>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Donation Records</h1>
    <p class="page-subtitle">Filter transactions, update payment status, and export audits.</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <form method="GET" action="{{ route('admin.donations.index') }}" class="table-filter-form" style="display:flex; flex-direction:column; gap:0.75rem; align-items:stretch">
        <div style="display:flex; gap:0.75rem; flex-wrap:wrap">
          <input type="date" name="start_date" class="form-input" value="{{ request('start_date') }}" title="Start Date">
          <input type="date" name="end_date" class="form-input" value="{{ request('end_date') }}" title="End Date">
          
          <select name="type" class="form-select">
            <option value="">All Types</option>
            <option value="zakat" {{ request('type') === 'zakat' ? 'selected' : '' }}>Zakat</option>
            <option value="sadaqa" {{ request('type') === 'sadaqa' ? 'selected' : '' }}>Sadaqa</option>
            <option value="emergency" {{ request('type') === 'emergency' ? 'selected' : '' }}>Emergency</option>
            <option value="general" {{ request('type') === 'general' ? 'selected' : '' }}>General</option>
          </select>

          <select name="status" class="form-select">
            <option value="">All Statuses</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
            <option value="refunded" {{ request('status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
          </select>
        </div>

        <div style="display:flex; gap:0.75rem; flex-wrap:wrap">
          <select name="user_id" class="form-select" style="flex:1; min-width:180px">
            <option value="">Filter by Donor</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
          </select>

          <select name="campaign_id" class="form-select" style="flex:1; min-width:180px">
            <option value="">Filter by Campaign</option>
            @foreach($campaigns as $camp)
              <option value="{{ $camp->id }}" {{ request('campaign_id') == $camp->id ? 'selected' : '' }}>{{ Str::limit($camp->title, 35) }}</option>
            @endforeach
          </select>

          <button type="submit" class="btn btn-primary btn-sm">Filter</button>
          <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary btn-sm">Reset</a>
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Txn ID</th>
            <th>Donor</th>
            <th>Campaign / Organization</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Method</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($donations as $donation)
            <tr>
              <td class="bold">{{ $donation->transaction_id }}</td>
              <td>{{ $donation->user ? $donation->user->name : ($donation->is_anonymous ? 'Anonymous' : 'Guest') }}</td>
              <td>
                <div class="bold">{{ $donation->campaign ? Str::limit($donation->campaign->title, 30) : 'General Fund' }}</div>
                <div class="activity-time" style="font-size:0.75rem">{{ $donation->organization ? $donation->organization->name : 'ZARIYAH Central' }}</div>
              </td>
              <td>PKR {{ number_format($donation->amount) }}</td>
              <td><span class="badge badge-info">{{ $donation->type }}</span></td>
              <td>{{ $donation->payment_method ?? 'N/A' }}</td>
              <td>
                <span class="badge badge-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'danger') }}">
                  {{ $donation->status }}
                </span>
              </td>
              <td>{{ $donation->created_at->format('M d, Y') }}</td>
              <td>
                <!-- Action updates -->
                <form method="POST" action="{{ route('admin.donations.status', $donation->id) }}" style="display:inline-flex; gap:4px">
                  @csrf
                  <select name="status" onchange="this.form.submit()" class="form-select" style="height:28px; padding:0 0.5rem; font-size:0.75rem">
                    <option value="pending" {{ $donation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $donation->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="failed" {{ $donation->status === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ $donation->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                  </select>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center">No donations match your filter criteria.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    <div class="pagination-wrapper">
      <div>Showing {{ $donations->firstItem() ?? 0 }} to {{ $donations->lastItem() ?? 0 }} of {{ $donations->total() }} donations</div>
      <div>{{ $donations->links() }}</div>
    </div>
  </div>
@endsection
