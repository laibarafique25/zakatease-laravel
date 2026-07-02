@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Organizations</li>
@endsection

@section('actions')
  <a href="{{ route('admin.organizations.create') }}" class="btn btn-primary btn-sm">➕ Add Organization</a>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Organization Workspace</h1>
    <p class="page-subtitle">Verify, approve, or suspend organization accounts and track their campaigns.</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <form method="GET" action="{{ route('admin.organizations.index') }}" class="table-filter-form">
        <input type="text" name="search" class="form-input" placeholder="Search by name, city..." value="{{ request('search') }}">
        
        <select name="status" class="form-select">
          <option value="">All Statuses</option>
          <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
          <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>

        <select name="verification" class="form-select">
          <option value="">All Verification</option>
          <option value="verified" {{ request('verification') === 'verified' ? 'selected' : '' }}>Verified</option>
          <option value="unverified" {{ request('verification') === 'unverified' ? 'selected' : '' }}>Unverified</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="{{ route('admin.organizations.index') }}" class="btn btn-secondary btn-sm">Reset</a>
      </form>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Website</th>
            <th>Location</th>
            <th>Status</th>
            <th>Verified</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($organizations as $org)
            <tr>
              <td class="bold">
                <a href="{{ route('admin.organizations.show', $org->id) }}" style="text-decoration:none; color:var(--text)">{{ $org->name }}</a>
              </td>
              <td>{{ $org->email ?? 'N/A' }}</td>
              <td>
                @if($org->website)
                  <a href="{{ $org->website }}" target="_blank" style="color:var(--accent)">{{ $org->website }}</a>
                @else
                  N/A
                @endif
              </td>
              <td>{{ $org->city }}, {{ $org->country }}</td>
              <td>
                <span class="badge badge-{{ $org->status === 'approved' ? 'success' : ($org->status === 'pending' ? 'warning' : 'danger') }}">
                  {{ $org->status }}
                </span>
              </td>
              <td>
                <span class="badge badge-{{ $org->is_verified ? 'success' : 'warning' }}">
                  {{ $org->is_verified ? 'Yes' : 'No' }}
                </span>
              </td>
              <td>
                <div class="flex-gap">
                  <a href="{{ route('admin.organizations.show', $org->id) }}" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem">👁️</a>
                  <a href="{{ route('admin.organizations.edit', $org->id) }}" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem">✏️</a>
                  
                  @if($org->status === 'pending')
                    <form method="POST" action="{{ route('admin.organizations.approve', $org->id) }}" style="display:inline">
                      @csrf
                      <button type="submit" class="btn btn-primary btn-sm" style="padding: 0.25rem 0.5rem; background:var(--success)">✓</button>
                    </form>
                    <button type="button" class="btn btn-danger btn-sm" style="padding: 0.25rem 0.5rem" onclick="openRejectModal('{{ $org->id }}')">✗</button>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center">No organizations registered yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    <div class="pagination-wrapper">
      <div>Showing {{ $organizations->firstItem() ?? 0 }} to {{ $organizations->lastItem() ?? 0 }} of {{ $organizations->total() }} organizations</div>
      <div>{{ $organizations->links() }}</div>
    </div>
  </div>

  <!-- Rejection Modal -->
  <div id="reject-modal" class="modal-overlay">
    <div class="modal-content">
      <button class="modal-close" onclick="closeRejectModal()">×</button>
      <h3 style="margin-bottom: 1rem">Reject Organization</h3>
      <form id="reject-form" method="POST" action="">
        @csrf
        <div class="form-group">
          <label for="rejection_reason">Reason for Rejection</label>
          <textarea id="rejection_reason" name="rejection_reason" class="form-control" placeholder="Specify reasons (e.g. invalid documentation or missing details)" required></textarea>
        </div>
        <div style="display:flex; justify-content: flex-end; gap: 1rem">
          <button type="button" class="btn btn-secondary" onclick="closeRejectModal()">Cancel</button>
          <button type="submit" class="btn btn-danger">Reject Organization</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openRejectModal(id) {
      const modal = document.getElementById('reject-modal');
      const form = document.getElementById('reject-form');
      form.action = '/admin/organizations/' + id + '/reject';
      modal.classList.add('open');
    }

    function closeRejectModal() {
      document.getElementById('reject-modal').classList.remove('open');
    }
  </script>
@endsection
