@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
  <li class="active">Add Campaign</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Create Campaign Proposal</h2>
    
    <form method="POST" action="{{ route('admin.campaigns.store') }}">
      @csrf

      <div class="form-group-grid">
        <div class="form-group">
          <label for="organization_id">Select Partner Organization</label>
          <select id="organization_id" name="organization_id" class="form-control" required>
            <option value="">Select Organization</option>
            @foreach($organizations as $org)
              <option value="{{ $org->id }}">{{ $org->name }}</option>
            @endforeach
          </select>
          @error('organization_id')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="title">Campaign Title</label>
          <input type="text" id="title" name="title" class="form-control" placeholder="e.g. Solar Water Wells in Tharparkar" value="{{ old('title') }}" required>
          @error('title')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group full-width">
        <label for="description">Campaign Description & Project Goals</label>
        <textarea id="description" name="description" class="form-control" placeholder="Detailed plan of how the funds will be utilized..." required>{{ old('description') }}</textarea>
        @error('description')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="goal_amount">Goal Amount (PKR)</label>
          <input type="number" id="goal_amount" name="goal_amount" class="form-control" placeholder="e.g. 500000" value="{{ old('goal_amount') }}" required>
          @error('goal_amount')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="type">Fund Type</label>
          <select id="type" name="type" class="form-control">
            <option value="zakat" selected>Zakat Eligible</option>
            <option value="sadaqa">Sadaqa</option>
            <option value="emergency">Emergency Relief</option>
            <option value="general">General Donations</option>
          </select>
          @error('type')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="start_date">Start Date</label>
          <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}">
          @error('start_date')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="end_date">End Date</label>
          <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}">
          @error('end_date')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div style="display:flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem">
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Publish Campaign</button>
      </div>
    </form>
  </div>
@endsection
