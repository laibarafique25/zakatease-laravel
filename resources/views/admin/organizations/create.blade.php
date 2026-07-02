@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.organizations.index') }}">Organizations</a></li>
  <li class="active">Add Organization</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Create Organization Profile</h2>
    
    <form method="POST" action="{{ route('admin.organizations.store') }}">
      @csrf

      <div class="form-group-grid">
        <div class="form-group">
          <label for="user_id">Link to Account (Role: Organization)</label>
          <select id="user_id" name="user_id" class="form-control" required>
            <option value="">Select Account</option>
            @foreach($usersWithoutOrg as $u)
              <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
            @endforeach
          </select>
          @error('user_id')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="name">Organization Name</label>
          <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Al-Mustafa Trust" value="{{ old('name') }}" required>
          @error('name')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group full-width">
        <label for="description">Profile Description</label>
        <textarea id="description" name="description" class="form-control" placeholder="Brief history, goals, and focus areas of the organization...">{{ old('description') }}</textarea>
        @error('description')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="website">Website URL</label>
          <input type="url" id="website" name="website" class="form-control" placeholder="https://example.org" value="{{ old('website') }}">
          @error('website')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="email">Public Contact Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="info@example.org" value="{{ old('email') }}">
          @error('email')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="phone">Contact Phone</label>
          <input type="text" id="phone" name="phone" class="form-control" placeholder="+9221111111..." value="{{ old('phone') }}">
          @error('phone')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" id="address" name="address" class="form-control" placeholder="e.g. Block 4, Clifton" value="{{ old('address') }}">
          @error('address')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" id="city" name="city" class="form-control" placeholder="e.g. Karachi" value="{{ old('city') }}">
          @error('city')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" id="country" name="country" class="form-control" value="Pakistan" required>
          @error('country')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div style="display:flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem">
        <a href="{{ route('admin.organizations.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Create Profile</button>
      </div>
    </form>
  </div>
@endsection
