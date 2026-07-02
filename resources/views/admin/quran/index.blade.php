@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Quranic Verses</li>
@endsection

@section('actions')
  <a href="{{ route('admin.quran.topics') }}" class="btn btn-secondary btn-sm">📁 Manage Topics</a>
  <a href="{{ route('admin.quran.create') }}" class="btn btn-primary btn-sm">➕ Add Verse</a>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Quranic Verse Library</h1>
    <p class="page-subtitle">Manage verses with Arabic, Urdu and English translations categorized by topic.</p>
  </div>

  <div class="table-card">
    <div class="table-header">
      <form method="GET" action="{{ route('admin.quran.index') }}" class="table-filter-form">
        <input type="text" name="search" class="form-input" placeholder="Search verse text..." value="{{ request('search') }}">
        <select name="topic_id" class="form-select">
          <option value="">All Topics</option>
          @foreach($topics as $topic)
            <option value="{{ $topic->id }}" {{ request('topic_id') == $topic->id ? 'selected' : '' }}>{{ $topic->name }}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="{{ route('admin.quran.index') }}" class="btn btn-secondary btn-sm">Reset</a>
      </form>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Verse Text</th>
            <th>Surah / Ayah</th>
            <th>Topic</th>
            <th>Featured</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($verses as $verse)
            <tr>
              <td style="max-width:400px">
                <div class="arabic-font" style="font-size:1.2rem;line-height:1.8">{{ $verse->arabic_text }}</div>
                <div class="urdu-font" style="font-size:.9rem;margin-top:8px;line-height:1.6;direction:rtl;text-align:right">{{ $verse->urdu_translation }}</div>
                <div class="activity-time" style="font-style:italic;margin-top:8px;font-size:.85rem;line-height:1.5">"{{ $verse->english_translation }}"</div>
              </td>
              <td>
                <div class="bold">{{ $verse->surah_name }}</div>
                <div class="activity-time">Surah {{ $verse->surah_number }}, Ayah {{ $verse->ayah_number }}</div>
              </td>
              <td><span class="badge badge-info">{{ $verse->topic ? $verse->topic->name : 'N/A' }}</span></td>
              <td><span class="badge badge-{{ $verse->is_featured ? 'success' : 'warning' }}">{{ $verse->is_featured ? 'Yes' : 'No' }}</span></td>
              <td class="text-right">
                <div class="flex-gap" style="justify-content:flex-end">
                  <a href="{{ route('admin.quran.edit', $verse->id) }}" class="btn btn-secondary btn-sm" style="padding:.25rem .5rem">✏️</a>
                  <form method="POST" action="{{ route('admin.quran.destroy', $verse->id) }}" style="display:inline" onsubmit="return confirm('Delete this verse?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="padding:.25rem .5rem">🗑️</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center">No verses found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="pagination-wrapper">
      <div>{{ $verses->total() }} verses total</div>
      <div>{{ $verses->links() }}</div>
    </div>
  </div>
@endsection
