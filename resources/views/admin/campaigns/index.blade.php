@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Campaigns</li>
@endsection

@section('actions')
  <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary btn-sm">➕ Add New Campaign</a>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Campaigns Desk</h1>
    <p class="page-subtitle">Track fundraising goals, verify organizations' requests, and feature urgent funds.</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <form method="GET" action="{{ route('admin.campaigns.index') }}" class="table-filter-form">
        <input type="text" name="search" class="form-input" placeholder="Search by title..." value="{{ request('search') }}">
        
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
          <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
          <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-secondary btn-sm">Reset</a>
      </form>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Organization</th>
            <th>Type</th>
            <th>Funding Metrics</th>
            <th>Status</th>
            <th>Featured</th>
            <th>Urgent</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($campaigns as $camp)
            <tr>
              <td class="bold">
                <a href="{{ route('admin.campaigns.show', $camp->id) }}" style="text-decoration:none; color:var(--text)">{{ $camp->title }}</a>
              </td>
              <td>{{ $camp->organization ? $camp->organization->name : 'N/A' }}</td>
              <td><span class="badge badge-info">{{ $camp->type }}</span></td>
              <td>
                @php
                  $pct = $camp->goal_amount > 0 ? min(round(($camp->raised_amount / $camp->goal_amount) * 100), 100) : 0;
                @endphp
                <div class="flex-gap">
                  <div class="bar-chart-wrapper" style="width: 80px; height: 8px">
                    <div class="bar-chart-fill" style="width: {{ $pct }}%"></div>
                  </div>
                  <span style="font-size:0.8rem">{{ $pct }}% (PKR {{ number_format($camp->raised_amount) }})</span>
                </div>
              </td>
              <td>
                <span class="badge badge-{{ $camp->status === 'approved' ? 'success' : ($camp->status === 'pending' ? 'warning' : 'danger') }}">
                  {{ $camp->status }}
                </span>
              </td>
              <td>
                <form method="POST" action="{{ route('admin.campaigns.toggle_featured', $camp->id) }}" style="display:inline">
                  @csrf
                  <button type="submit" class="badge badge-{{ $camp->is_featured ? 'success' : 'warning' }}" style="border:none; cursor:pointer" title="Click to Toggle">
                    {{ $camp->is_featured ? 'Yes' : 'No' }}
                  </button>
                </form>
              </td>
              <td>
                <form method="POST" action="{{ route('admin.campaigns.toggle_urgent', $camp->id) }}" style="display:inline">
                  @csrf
                  <button type="submit" class="badge badge-{{ $camp->is_urgent ? 'danger' : 'warning' }}" style="border:none; cursor:pointer" title="Click to Toggle">
                    {{ $camp->is_urgent ? 'Yes' : 'No' }}
                  </button>
                </form>
              </td>
              <td>
                <div class="flex-gap">
                  <a href="{{ route('admin.campaigns.show', $camp->id) }}" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem">👁️</a>
                  <a href="{{ route('admin.campaigns.edit', $camp->id) }}" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem">✏️</a>
                  
                  @if($camp->status === 'pending')
                    <form method="POST" action="{{ route('admin.campaigns.approve', $camp->id) }}" style="display:inline">
                      @csrf
                      <button type="submit" class="btn btn-primary btn-sm" style="padding: 0.25rem 0.5rem; background:var(--success)">✓</button>
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" style="padding: 0.25rem 0.5rem" onclick="openRejectModal('{{ $camp->id }}')">✗</button>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center">No campaigns found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    <div class="pagination-wrapper">
      <div>Showing {{ $campaigns->firstItem() ?? 0 }} to {{ $campaigns->lastItem() ?? 0 }} of {{ $campaigns->total() }} campaigns</div>
      <div>{{ $campaigns->links() }}</div>
    </div>
  </div>

  <!-- Rejection Modal -->
  <div id="reject-modal" class="modal-overlay">
    <div class="modal-content">
      <button class="modal-close" onclick="closeRejectModal()">×</button>
      <h3 style="margin-bottom: 1rem">Reject Campaign Request</h3>
      <form id="reject-form" method="POST" action="">
        @csrf
        <div class="form-group">
          <label for="rejection_reason">Specify Reason</label>
          <textarea id="rejection_reason" name="rejection_reason" class="form-control" placeholder="Identify issues (e.g. invalid documentation or incorrect bank settings)" required></textarea>
        </div>
        <div style="display:flex; justify-content: flex-end; gap: 1rem">
          <button type="button" class="btn btn-secondary" onclick="closeRejectModal()">Cancel</button>
          <button type="submit" class="btn btn-danger">Confirm Rejection</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openRejectModal(id) {
      const modal = document.getElementById('reject-modal');
      const form = document.getElementById('reject-form');
      form.action = '/admin/campaigns/' + id + '/reject';
      modal.classList.add('open');
    }

    function closeRejectModal() {
      document.getElementById('reject-modal').classList.remove('open');
    }
  </script>
@endsection
