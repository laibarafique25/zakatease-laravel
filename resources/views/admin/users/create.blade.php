@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.users.index') }}">Users</a></li>
  <li class="active">Add User</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Create User Account</h2>
    
    <form method="POST" action="{{ route('admin.users.store') }}">
      @csrf

      <div class="form-group-grid">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Abdullah Khan" value="{{ old('name') }}" required>
          @error('name')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="e.g. user@zariyah.com" value="{{ old('email') }}" required>
          @error('email')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Min 8 characters" required>
          @error('password')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="text" id="phone" name="phone" class="form-control" placeholder="e.g. +923001234567" value="{{ old('phone') }}">
          @error('phone')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="role">User Role</label>
          <select id="role" name="role" class="form-control">
            <option value="user" selected>Regular User</option>
            <option value="donor">Donor</option>
            <option value="receiver">Receiver</option>
            <option value="organization">Organization Partner</option>
            <option value="admin">Administrator</option>
            <option value="super_admin">Super Admin</option>
          </select>
          @error('role')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status" class="form-control">
            <option value="active" selected>Active</option>
            <option value="inactive">Inactive</option>
            <option value="banned">Banned</option>
          </select>
          @error('status')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div style="display:flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Create User</button>
      </div>
    </form>
  </div>
@endsection
