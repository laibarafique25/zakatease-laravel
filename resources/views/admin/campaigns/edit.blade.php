@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
  <li class="active">Edit Campaign</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Edit Campaign Details</h2>
    
    <form method="POST" action="{{ route('admin.campaigns.update', $campaign->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group-grid">
        <div class="form-group">
          <label for="title">Campaign Title</label>
          <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $campaign->title) }}" required>
          @error('title')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="status">Campaign Status</label>
          <select id="status" name="status" class="form-control">
            <option value="draft" {{ old('status', $campaign->status) === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="pending" {{ old('status', $campaign->status) === 'pending' ? 'selected' : '' }}>Pending Review</option>
            <option value="approved" {{ old('status', $campaign->status) === 'approved' ? 'selected' : '' }}>Approved & Live</option>
            <option value="rejected" {{ old('status', $campaign->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="completed" {{ old('status', $campaign->status) === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="suspended" {{ old('status', $campaign->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
          </select>
          @error('status')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group full-width" id="rejection-reason-group" style="display: {{ old('status', $campaign->status) === 'rejected' ? 'block' : 'none' }}">
        <label for="rejection_reason">Rejection Notes</label>
        <textarea id="rejection_reason" name="rejection_reason" class="form-control">{{ old('rejection_reason', $campaign->rejection_reason) }}</textarea>
        @error('rejection_reason')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group full-width">
        <label for="description">Campaign Description & Project Goals</label>
        <textarea id="description" name="description" class="form-control" required>{{ old('description', $campaign->description) }}</textarea>
        @error('description')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="goal_amount">Goal Amount (PKR)</label>
          <input type="number" id="goal_amount" name="goal_amount" class="form-control" value="{{ old('goal_amount', $campaign->goal_amount) }}" required>
          @error('goal_amount')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="type">Fund Type</label>
          <select id="type" name="type" class="form-control">
            <option value="zakat" {{ old('type', $campaign->type) === 'zakat' ? 'selected' : '' }}>Zakat Eligible</option>
            <option value="sadaqa" {{ old('type', $campaign->type) === 'sadaqa' ? 'selected' : '' }}>Sadaqa</option>
            <option value="emergency" {{ old('type', $campaign->type) === 'emergency' ? 'selected' : '' }}>Emergency Relief</option>
            <option value="general" {{ old('type', $campaign->type) === 'general' ? 'selected' : '' }}>General Donations</option>
          </select>
          @error('type')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="start_date">Start Date</label>
          <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', $campaign->start_date ? $campaign->start_date->toDateString() : '') }}">
          @error('start_date')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="end_date">End Date</label>
          <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->toDateString() : '') }}">
          @error('end_date')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div style="display:flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem">
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-secondary">Cancel</a>
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
