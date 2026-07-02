@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">AI Knowledge Base</li>
@endsection

@section('actions')
  <a href="{{ route('admin.ai.create') }}" class="btn btn-primary btn-sm">➕ Add Entry</a>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">AI Fiqh Knowledge Base</h1>
    <p class="page-subtitle">Curate verified Islamic Q&A entries that power the ZARIYAH smart assistant.</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <form method="GET" action="{{ route('admin.ai.index') }}" class="table-filter-form">
        <input type="text" name="search" class="form-input" placeholder="Search by question or topic..." value="{{ request('search') }}">
        <select name="category" class="form-select">
          <option value="">All Categories</option>
          <option value="zakat" {{ request('category') === 'zakat' ? 'selected' : '' }}>Zakat</option>
          <option value="prayer" {{ request('category') === 'prayer' ? 'selected' : '' }}>Prayer</option>
          <option value="fasting" {{ request('category') === 'fasting' ? 'selected' : '' }}>Fasting</option>
          <option value="hajj" {{ request('category') === 'hajj' ? 'selected' : '' }}>Hajj</option>
          <option value="general" {{ request('category') === 'general' ? 'selected' : '' }}>General</option>
        </select>
        <select name="is_active" class="form-select">
          <option value="">All Status</option>
          <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
          <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="{{ route('admin.ai.index') }}" class="btn btn-secondary btn-sm">Reset</a>
      </form>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Question</th>
            <th>Category</th>
            <th>Confidence</th>
            <th>Source</th>
            <th>Status</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($entries as $entry)
            <tr>
              <td style="max-width:350px">
                <div class="bold" style="font-size:.9rem">{{ $entry->question }}</div>
                <div class="activity-time" style="font-size:.8rem;margin-top:4px">{{ Str::limit($entry->answer, 120) }}</div>
              </td>
              <td><span class="badge badge-info">{{ $entry->category }}</span></td>
              <td>
                <div class="flex-gap">
                  <div class="bar-chart-wrapper" style="width:60px;height:8px">
                    <div class="bar-chart-fill" style="width:{{ $entry->confidence_score }}%"></div>
                  </div>
                  <span style="font-size:.8rem">{{ $entry->confidence_score }}%</span>
                </div>
              </td>
              <td>{{ $entry->source ?? 'Internal' }}</td>
              <td>
                <span class="badge badge-{{ $entry->is_active ? 'success' : 'warning' }}">
                  {{ $entry->is_active ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td class="text-right">
                <div class="flex-gap" style="justify-content:flex-end">
                  <a href="{{ route('admin.ai.edit', $entry->id) }}" class="btn btn-secondary btn-sm" style="padding:.25rem .5rem">✏️</a>
                  <form method="POST" action="{{ route('admin.ai.destroy', $entry->id) }}" style="display:inline" onsubmit="return confirm('Delete this AI entry?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="padding:.25rem .5rem">🗑️</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center">No AI knowledge entries found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="pagination-wrapper">
      <div>{{ $entries->total() }} entries total</div>
      <div>{{ $entries->links() }}</div>
    </div>
  </div>
@endsection
