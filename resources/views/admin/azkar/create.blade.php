@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.azkar.index') }}">Azkar Collection</a></li>
  <li class="active">Add Supplication</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Add Supplication / Dhikr</h2>
    <form method="POST" action="{{ route('admin.azkar.store') }}">
      @csrf

      <div class="form-group-grid">
        <div class="form-group">
          <label for="category_id">Category</label>
          <select id="category_id" name="category_id" class="form-control" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
          @error('category_id')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label for="repeat_count">Repeat Count</label>
          <input type="number" id="repeat_count" name="repeat_count" class="form-control" value="{{ old('repeat_count', 1) }}" min="1" required>
          @error('repeat_count')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group full-width">
        <label for="arabic_text">Arabic Text</label>
        <textarea id="arabic_text" name="arabic_text" class="form-control arabic-font" style="min-height:90px;direction:rtl;text-align:right;font-size:1.2rem" placeholder="سُبْحَانَ اللَّهِ..." required>{{ old('arabic_text') }}</textarea>
        @error('arabic_text')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group full-width">
        <label for="urdu_translation">Urdu Translation</label>
        <textarea id="urdu_translation" name="urdu_translation" class="form-control urdu-font" style="min-height:80px;direction:rtl;text-align:right" placeholder="اللہ پاک ہے...">{{ old('urdu_translation') }}</textarea>
      </div>

      <div class="form-group full-width">
        <label for="english_translation">English Translation</label>
        <textarea id="english_translation" name="english_translation" class="form-control" style="min-height:80px" placeholder="Glory be to Allah..." required>{{ old('english_translation') }}</textarea>
        @error('english_translation')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="reference">Reference (Hadith or Quran)</label>
          <input type="text" id="reference" name="reference" class="form-control" placeholder="e.g. Sahih Bukhari 6406" value="{{ old('reference') }}">
        </div>
        <div class="form-group">
          <label for="benefits">Benefits / Virtues</label>
          <input type="text" id="benefits" name="benefits" class="form-control" placeholder="e.g. Recited 100 times forgives all sins" value="{{ old('benefits') }}">
        </div>
      </div>

      <div class="form-group">
        <div style="display:flex;align-items:center;gap:8px">
          <input type="checkbox" id="is_featured" name="is_featured" value="1">
          <label for="is_featured" style="margin:0">Feature this Supplication</label>
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:1rem;margin-top:1.5rem">
        <a href="{{ route('admin.azkar.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Supplication</button>
      </div>
    </form>
  </div>
@endsection
