@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.users.index') }}">Users</a></li>
  <li class="active">Edit User</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Edit User Profile</h2>
    
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group-grid">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
          @error('name')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          @error('email')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="role">User Role</label>
          <select id="role" name="role" class="form-control">
            <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Regular User</option>
            <option value="donor" {{ old('role', $user->role) === 'donor' ? 'selected' : '' }}>Donor</option>
            <option value="receiver" {{ old('role', $user->role) === 'receiver' ? 'selected' : '' }}>Receiver</option>
            <option value="organization" {{ old('role', $user->role) === 'organization' ? 'selected' : '' }}>Organization Partner</option>
            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
            <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
          </select>
          @error('role')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="status">Account Status</label>
          <select id="status" name="status" class="form-control">
            <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="banned" {{ old('status', $user->status) === 'banned' ? 'selected' : '' }}>Banned</option>
          </select>
          @error('status')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
          @error('phone')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="trust_score">Trust Score (%)</label>
          <input type="number" id="trust_score" name="trust_score" class="form-control" min="0" max="100" value="{{ old('trust_score', $user->trust_score) }}">
          @error('trust_score')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div style="display:flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
@endsection
