@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Users</li>
@endsection

@section('actions')
  <a href="{{ route('admin.users.export') }}" class="btn btn-secondary btn-sm">📥 Export CSV</a>
  <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">➕ Add New User</a>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">User Management</h1>
    <p class="page-subtitle">Promote, demote, verify, activate or deactivate accounts on ZARIYAH.</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <!-- Search & Filters -->
      <form method="GET" action="{{ route('admin.users.index') }}" class="table-filter-form">
        <input type="text" name="search" class="form-input" placeholder="Search by name or email..." value="{{ request('search') }}">
        
        <select name="role" class="form-select">
          <option value="">All Roles</option>
          <option value="super_admin" {{ request('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
          <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
          <option value="organization" {{ request('role') === 'organization' ? 'selected' : '' }}>Organization</option>
          <option value="donor" {{ request('role') === 'donor' ? 'selected' : '' }}>Donor</option>
          <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Regular User</option>
        </select>

        <select name="status" class="form-select">
          <option value="">All Statuses</option>
          <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
          <option value="banned" {{ request('status') === 'banned' ? 'selected' : '' }}>Banned</option>
        </select>

        <select name="verification" class="form-select">
          <option value="">All Verification</option>
          <option value="verified" {{ request('verification') === 'verified' ? 'selected' : '' }}>Verified</option>
          <option value="unverified" {{ request('verification') === 'unverified' ? 'selected' : '' }}>Unverified</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Reset</a>
      </form>
    </div>

    <!-- Users Table -->
    <form id="bulk-delete-form" method="POST" action="{{ route('admin.users.bulk_delete') }}">
      @csrf
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th style="width: 40px"><input type="checkbox" id="select-all-checkbox"></th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Trust Score</th>
              <th>Status</th>
              <th>Verification</th>
              <th>Registered</th>
              <th class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
              <tr>
                <td>
                  @if($user->id !== auth()->id())
                    <input type="checkbox" name="ids[]" value="{{ $user->id }}" class="user-checkbox">
                  @endif
                </td>
                <td class="bold">
                  <div class="flex-gap">
                    <div class="profile-avatar" style="width: 32px; height: 32px; font-size: 0.85rem">
                      {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                      <a href="{{ route('admin.users.show', $user->id) }}" style="text-decoration:none; color:var(--text)">{{ $user->name }}</a>
                      <div class="activity-time" style="font-size:0.75rem">{{ $user->phone ?? 'No phone' }}</div>
                    </div>
                  </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                  <span class="badge badge-info">{{ $user->role }}</span>
                </td>
                <td>
                  <div class="flex-gap">
                    <div class="bar-chart-wrapper" style="width: 60px; height: 8px">
                      <div class="bar-chart-fill" style="width: {{ $user->trust_score }}%"></div>
                    </div>
                    <span style="font-size: 0.8rem">{{ $user->trust_score }}%</span>
                  </div>
                </td>
                <td>
                  <form method="POST" action="{{ route('admin.users.toggle_status', $user->id) }}" style="display:inline">
                    @csrf
                    <button type="submit" class="badge badge-{{ $user->status === 'active' ? 'success' : 'danger' }}" style="border:none; cursor:pointer" title="Click to Toggle">
                      {{ $user->status }}
                    </button>
                  </form>
                </td>
                <td>
                  <form method="POST" action="{{ route('admin.users.toggle_verification', $user->id) }}" style="display:inline">
                    @csrf
                    <button type="submit" class="badge badge-{{ $user->is_verified ? 'success' : 'warning' }}" style="border:none; cursor:pointer" title="Click to Toggle">
                      {{ $user->is_verified ? 'Verified' : 'Unverified' }}
                    </button>
                  </form>
                </td>
                <td>{{ $user->created_at->toDateString() }}</td>
                <td class="text-right">
                  <div class="flex-gap" style="justify-content: flex-end">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem">✏️</a>
                    @if($user->id !== auth()->id())
                      <button type="button" class="btn btn-danger btn-sm" style="padding: 0.25rem 0.5rem" onclick="confirmDelete('{{ $user->id }}')">🗑️</button>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="text-center">No users match the search criteria.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      
      <div class="pagination-wrapper">
        <div>
          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to bulk delete selected users?')">🗑️ Delete Selected</button>
        </div>
        <div>
          {{ $users->links() }}
        </div>
      </div>
    </form>
  </div>

  @foreach($users as $user)
    @if($user->id !== auth()->id())
      <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:none">
        @csrf
        @method('DELETE')
      </form>
    @endif
  @endforeach

  <script>
    document.getElementById('select-all-checkbox').addEventListener('change', function(e) {
      document.querySelectorAll('.user-checkbox').forEach(box => {
        box.checked = e.target.checked;
      });
    });

    function confirmDelete(id) {
      if(confirm('Are you sure you want to delete this user? This will remove all associated logs and organization details.')) {
        document.getElementById('delete-form-' + id).submit();
      }
    }
  </script>
@endsection
