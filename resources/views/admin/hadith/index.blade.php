@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Hadith Collection</li>
@endsection

@section('actions')
  <a href="{{ route('admin.hadith.categories') }}" class="btn btn-secondary btn-sm">📁 Manage Categories</a>
  <a href="{{ route('admin.hadith.create') }}" class="btn btn-primary btn-sm">➕ Add Hadith</a>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Hadith Library</h1>
    <p class="page-subtitle">Publish authentic teachings, adjust gradings (Sahih, Hasan), and categorize narrations.</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <form method="GET" action="{{ route('admin.hadith.index') }}" class="table-filter-form">
        <input type="text" name="search" class="form-input" placeholder="Search by narration or source..." value="{{ request('search') }}">
        
        <select name="category_id" class="form-select">
          <option value="">All Categories</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>

        <select name="grade" class="form-select">
          <option value="">All Grades</option>
          <option value="sahih" {{ request('grade') === 'sahih' ? 'selected' : '' }}>Sahih</option>
          <option value="hasan" {{ request('grade') === 'hasan' ? 'selected' : '' }}>Hasan</option>
          <option value="daif" {{ request('grade') === 'daif' ? 'selected' : '' }}>Daif</option>
          <option value="unknown" {{ request('grade') === 'unknown' ? 'selected' : '' }}>Unknown</option>
        </select>

        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="{{ route('admin.hadith.index') }}" class="btn btn-secondary btn-sm">Reset</a>
      </form>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Arabic Text / Translations</th>
            <th>Category</th>
            <th>Source / Ref</th>
            <th>Grade</th>
            <th>Featured</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($hadiths as $hadith)
            <tr>
              <td style="max-width:400px">
                <div class="arabic-font" style="font-size:1.15rem; line-height: 1.6">{{ $hadith->arabic_text }}</div>
                <div class="urdu-font" style="font-size:0.9rem; margin-top:8px; line-height: 1.5">{{ $hadith->urdu_translation }}</div>
                <div class="activity-time" style="font-size:0.85rem; font-style:italic; margin-top:8px; line-height:1.5">"{{ $hadith->english_translation }}"</div>
              </td>
              <td><span class="badge badge-info">{{ $hadith->category ? $hadith->category->name : 'N/A' }}</span></td>
              <td>
                <div class="bold">{{ $hadith->source }}</div>
                <div class="activity-time">No. {{ $hadith->hadith_number ?? 'N/A' }}</div>
              </td>
              <td>
                <span class="badge badge-{{ $hadith->grade === 'sahih' ? 'success' : ($hadith->grade === 'hasan' ? 'info' : 'danger') }}">
                  {{ $hadith->grade }}
                </span>
              </td>
              <td>
                <span class="badge badge-{{ $hadith->is_featured ? 'success' : 'warning' }}">{{ $hadith->is_featured ? 'Yes' : 'No' }}</span>
              </td>
              <td class="text-right">
                <div class="flex-gap" style="justify-content: flex-end">
                  <a href="{{ route('admin.hadith.edit', $hadith->id) }}" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem">✏️</a>
                  <form method="POST" action="{{ route('admin.hadith.destroy', $hadith->id) }}" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this Hadith?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.25rem 0.5rem">🗑️</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No Hadiths logged yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    <div class="pagination-wrapper">
      <div>Showing {{ $hadiths->firstItem() ?? 0 }} to {{ $hadiths->lastItem() ?? 0 }} of {{ $hadiths->total() }} entries</div>
      <div>{{ $hadiths->links() }}</div>
    </div>
  </div>
@endsection
