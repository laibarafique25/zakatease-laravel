@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.hadith.index') }}">Hadith Collection</a></li>
  <li class="active">Add Hadith</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Add Hadith Narration</h2>
    
    <form method="POST" action="{{ route('admin.hadith.store') }}">
      @csrf

      <div class="form-group-grid">
        <div class="form-group">
          <label for="category_id">Hadith Category</label>
          <select id="category_id" name="category_id" class="form-control" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
          @error('category_id')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="grade">Hadith Grade</label>
          <select id="grade" name="grade" class="form-control">
            <option value="sahih" selected>Sahih (Authentic)</option>
            <option value="hasan">Hasan (Good)</option>
            <option value="daif">Daif (Weak)</option>
            <option value="unknown">Unknown / Not graded</option>
          </select>
          @error('grade')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group full-width">
        <label for="arabic_text">Arabic Text</label>
        <textarea id="arabic_text" name="arabic_text" class="form-control" style="min-height:90px; direction:rtl; text-align:right" placeholder="العلم نور..." required>{{ old('arabic_text') }}</textarea>
        @error('arabic_text')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group full-width">
        <label for="urdu_translation">Urdu Translation</label>
        <textarea id="urdu_translation" name="urdu_translation" class="form-control" style="min-height:90px; direction:rtl; text-align:right" placeholder="علم روشنی ہے...">{{ old('urdu_translation') }}</textarea>
        @error('urdu_translation')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group full-width">
        <label for="english_translation">English Translation</label>
        <textarea id="english_translation" name="english_translation" class="form-control" style="min-height:90px" placeholder="Knowledge is light..." required>{{ old('english_translation') }}</textarea>
        @error('english_translation')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="source">Source (Collection Book)</label>
          <input type="text" id="source" name="source" class="form-control" placeholder="e.g. Sahih Bukhari" value="{{ old('source') }}">
          @error('source')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
          <label for="hadith_number">Hadith Number</label>
          <input type="text" id="hadith_number" name="hadith_number" class="form-control" placeholder="e.g. 2611" value="{{ old('hadith_number') }}">
          @error('hadith_number')<span style="color:var(--danger); font-size:0.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group">
        <div style="display:flex; align-items:center; gap:8px">
          <input type="checkbox" id="is_featured" name="is_featured" value="1">
          <label for="is_featured" style="margin:0">Mark Featured Narration</label>
        </div>
      </div>

      <div style="display:flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem">
        <a href="{{ route('admin.hadith.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Create Hadith</button>
      </div>
    </form>
  </div>
@endsection
