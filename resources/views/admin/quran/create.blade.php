@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.quran.index') }}">Quranic Verses</a></li>
  <li class="active">Add Verse</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Add Quranic Verse</h2>
    <form method="POST" action="{{ route('admin.quran.store') }}">
      @csrf

      <div class="form-group-grid">
        <div class="form-group">
          <label for="topic_id">Thematic Topic</label>
          <select id="topic_id" name="topic_id" class="form-control">
            <option value="">No Topic</option>
            @foreach($topics as $topic)
              <option value="{{ $topic->id }}">{{ $topic->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="surah_name">Surah Name</label>
          <input type="text" id="surah_name" name="surah_name" class="form-control" placeholder="e.g. Al-Baqarah" value="{{ old('surah_name') }}" required>
          @error('surah_name')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="surah_number">Surah Number</label>
          <input type="number" id="surah_number" name="surah_number" class="form-control" value="{{ old('surah_number') }}" min="1" max="114" required>
          @error('surah_number')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label for="ayah_number">Ayah Number</label>
          <input type="number" id="ayah_number" name="ayah_number" class="form-control" value="{{ old('ayah_number') }}" min="1" required>
          @error('ayah_number')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group full-width">
        <label for="arabic_text">Arabic Text</label>
        <textarea id="arabic_text" name="arabic_text" class="form-control arabic-font" style="min-height:100px;direction:rtl;text-align:right;font-size:1.3rem" required>{{ old('arabic_text') }}</textarea>
        @error('arabic_text')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group full-width">
        <label for="urdu_translation">Urdu Translation</label>
        <textarea id="urdu_translation" name="urdu_translation" class="form-control urdu-font" style="min-height:80px;direction:rtl;text-align:right">{{ old('urdu_translation') }}</textarea>
      </div>

      <div class="form-group full-width">
        <label for="english_translation">English Translation</label>
        <textarea id="english_translation" name="english_translation" class="form-control" style="min-height:80px" required>{{ old('english_translation') }}</textarea>
        @error('english_translation')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group full-width">
        <label for="tafsir">Tafsir / Explanation (Optional)</label>
        <textarea id="tafsir" name="tafsir" class="form-control" style="min-height:80px" placeholder="Brief scholarly explanation of this verse...">{{ old('tafsir') }}</textarea>
      </div>

      <div class="form-group">
        <div style="display:flex;align-items:center;gap:8px">
          <input type="checkbox" id="is_featured" name="is_featured" value="1">
          <label for="is_featured" style="margin:0">Feature on Homepage</label>
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:1rem;margin-top:1.5rem">
        <a href="{{ route('admin.quran.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Verse</button>
      </div>
    </form>
  </div>
@endsection
