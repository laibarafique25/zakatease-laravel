@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.azkar.index') }}">Azkar Collection</a></li>
  <li class="active">Edit Supplication</li>
@endsection

@section('content')
  <div class="form-card">
    <h2 class="form-title">Edit Supplication / Dhikr</h2>
    <form method="POST" action="{{ route('admin.azkar.update', $azkar->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group-grid">
        <div class="form-group">
          <label for="category_id">Category</label>
          <select id="category_id" name="category_id" class="form-control" required>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id', $azkar->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
          @error('category_id')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label for="repeat_count">Repeat Count</label>
          <input type="number" id="repeat_count" name="repeat_count" class="form-control" value="{{ old('repeat_count', $azkar->repeat_count) }}" min="1" required>
          @error('repeat_count')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
        </div>
      </div>

      <div class="form-group full-width">
        <label for="arabic_text">Arabic Text</label>
        <textarea id="arabic_text" name="arabic_text" class="form-control arabic-font" style="min-height:90px;direction:rtl;text-align:right;font-size:1.2rem" required>{{ old('arabic_text', $azkar->arabic_text) }}</textarea>
        @error('arabic_text')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group full-width">
        <label for="urdu_translation">Urdu Translation</label>
        <textarea id="urdu_translation" name="urdu_translation" class="form-control urdu-font" style="min-height:80px;direction:rtl;text-align:right">{{ old('urdu_translation', $azkar->urdu_translation) }}</textarea>
      </div>

      <div class="form-group full-width">
        <label for="english_translation">English Translation</label>
        <textarea id="english_translation" name="english_translation" class="form-control" style="min-height:80px" required>{{ old('english_translation', $azkar->english_translation) }}</textarea>
        @error('english_translation')<span style="color:var(--danger);font-size:.8rem">{{ $message }}</span>@enderror
      </div>

      <div class="form-group-grid">
        <div class="form-group">
          <label for="reference">Reference</label>
          <input type="text" id="reference" name="reference" class="form-control" value="{{ old('reference', $azkar->reference) }}">
        </div>
        <div class="form-group">
          <label for="benefits">Benefits / Virtues</label>
          <input type="text" id="benefits" name="benefits" class="form-control" value="{{ old('benefits', $azkar->benefits) }}">
        </div>
      </div>

      <div class="form-group">
        <div style="display:flex;align-items:center;gap:8px">
          <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $azkar->is_featured) ? 'checked' : '' }}>
          <label for="is_featured" style="margin:0">Featured Supplication</label>
        </div>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:1rem;margin-top:1.5rem">
        <a href="{{ route('admin.azkar.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
@endsection
