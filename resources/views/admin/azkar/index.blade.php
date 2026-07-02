@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Azkar Collection</li>
@endsection

@section('actions')
  <a href="{{ route('admin.azkar.categories') }}" class="btn btn-secondary btn-sm">📁 Manage Categories</a>
  <a href="{{ route('admin.azkar.create') }}" class="btn btn-primary btn-sm">➕ Add Azkar</a>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Remembrance & Supplications</h1>
    <p class="page-subtitle">Publish morning/evening supplications, repeat counters, benefits details, and audio files.</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <form method="GET" action="{{ route('admin.azkar.index') }}" class="table-filter-form">
        <input type="text" name="search" class="form-input" placeholder="Search by text, reference..." value="{{ request('search') }}">
        
        <select name="category_id" class="form-select">
          <option value="">All Categories</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>

        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="{{ route('admin.azkar.index') }}" class="btn btn-secondary btn-sm">Reset</a>
      </form>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Arabic Supplication</th>
            <th>Category</th>
            <th>Counter / Audio</th>
            <th>Reference</th>
            <th>Featured</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($azkars as $azkar)
            <tr>
              <td style="max-width:400px">
                <div class="arabic-font" style="font-size:1.15rem; line-height: 1.6">{{ $azkar->arabic_text }}</div>
                <div class="urdu-font" style="font-size:0.9rem; margin-top:8px; line-height: 1.5">{{ $azkar->urdu_translation }}</div>
                <div class="activity-time" style="font-size:0.85rem; font-style:italic; margin-top:8px; line-height:1.5">"{{ $azkar->english_translation }}"</div>
              </td>
              <td><span class="badge badge-info">{{ $azkar->category ? $azkar->category->name : 'N/A' }}</span></td>
              <td>
                <div class="bold">Repeat: {{ $azkar->repeat_count }}x</div>
                @if($azkar->audio_path)
                  <audio controls style="max-width:140px; height:28px; margin-top:8px">
                    <source src="{{ asset('storage/' . $azkar->audio_path) }}" type="audio/mpeg">
                  </audio>
                @else
                  <div class="activity-time">No audio</div>
                @endif
              </td>
              <td>
                <div class="bold" style="font-size:0.8rem">{{ $azkar->reference }}</div>
              </td>
              <td>
                <span class="badge badge-{{ $azkar->is_featured ? 'success' : 'warning' }}">{{ $azkar->is_featured ? 'Yes' : 'No' }}</span>
              </td>
              <td class="text-right">
                <div class="flex-gap" style="justify-content: flex-end">
                  <a href="{{ route('admin.azkar.edit', $azkar->id) }}" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem">✏️</a>
                  <form method="POST" action="{{ route('admin.azkar.destroy', $azkar->id) }}" style="display:inline" onsubmit="return confirm('Delete supplication record?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.25rem 0.5rem">🗑️</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No Azkar supplications logged.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    <div class="pagination-wrapper">
      <div>Showing {{ $azkars->firstItem() ?? 0 }} to {{ $azkars->lastItem() ?? 0 }} of {{ $azkars->total() }} entries</div>
      <div>{{ $azkars->links() }}</div>
    </div>
  </div>
@endsection
