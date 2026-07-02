@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.organizations.index') }}">Organizations</a></li>
  <li class="active">Edit Organization</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Edit Organization Profile</h2>
    
    <form method="POST" action="{{ route('admin.organizations.update', $organization->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group-grid">
        <div class="form-group">
          <label for="name">Organization Name</label>
          <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $organization->name) }}" required>
          @error('name')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="status">Account Status</label>
          <select id="status" name="status" class="form-control">
            <option value="pending" {{ old('status', $organization->status) === 'pending' ? 'selected' : '' }}>Pending Approval</option>
            <option value="approved" {{ old('status', $organization->status) === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ old('status', $organization->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="suspended" {{ old('status', $organization->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
          </select>
          @error('status')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group full-width" id="rejection-reason-group" style="display: {{ old('status', $organization->status) === 'rejected' ? 'block' : 'none' }}">
        <label for="rejection_reason">Rejection Reason</label>
        <textarea id="rejection_reason" name="rejection_reason" class="form-control">{{ old('rejection_reason', $organization->rejection_reason) }}</textarea>
        @error('rejection_reason')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group full-width">
        <label for="description">Profile Description</label>
        <textarea id="description" name="description" class="form-control">{{ old('description', $organization->description) }}</textarea>
        @error('description')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="website">Website URL</label>
          <input type="url" id="website" name="website" class="form-control" value="{{ old('website', $organization->website) }}">
          @error('website')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="email">Public Contact Email</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $organization->email) }}">
          @error('email')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="phone">Contact Phone</label>
          <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $organization->phone) }}">
          @error('phone')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $organization->address) }}">
          @error('address')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $organization->city) }}">
          @error('city')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" id="country" name="country" class="form-control" value="{{ old('country', $organization->country) }}" required>
          @error('country')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid" style="margin-top: 1rem">
        <div style="display:flex; align-items:center; gap: 8px">
          <input type="checkbox" id="is_verified" name="is_verified" value="1" {{ old('is_verified', $organization->is_verified) ? 'checked' : '' }}>
          <label for="is_verified" style="margin: 0">Mark Verified Partner</label>
        </div>

        <div style="display:flex; align-items:center; gap: 8px">
          <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $organization->is_featured) ? 'checked' : '' }}>
          <label for="is_featured" style="margin: 0">Feature on Homepage</label>
        </div>
      </div>

      <div style="display:flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem">
        <a href="{{ route('admin.organizations.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>

  <script>
    document.getElementById('status').addEventListener('change', function(e) {
      const reasonDiv = document.getElementById('rejection-reason-group');
      if (e.target.value === 'rejected') {
        reasonDiv.style.display = 'block';
      } else {
        reasonDiv.style.display = 'none';
      }
    });
  </script>
@endsection
