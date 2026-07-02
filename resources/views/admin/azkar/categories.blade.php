@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.azkar.index') }}">Azkar Collection</a></li>
  <li class="active">Categories</li>
@endsection

@section('actions')
  <button onclick="openCategoryModal()" class="btn btn-primary btn-sm">➕ Add Category</button>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Azkar Categories</h1>
    <p class="page-subtitle">Group supplications by time (Morning, Evening) or theme (Sleeping, Travel, Eating).</p>
  </div>

  <div class="table-card">
    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Icon</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Order</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $cat)
            <tr>
              <td style="font-size:1.5rem">{{ $cat->icon ?? '📿' }}</td>
              <td class="bold">{{ $cat->name }}</td>
              <td><code>{{ $cat->slug }}</code></td>
              <td>{{ $cat->description ?? '—' }}</td>
              <td>{{ $cat->order }}</td>
              <td class="text-right">
                <div class="flex-gap" style="justify-content:flex-end">
                  <button onclick="openEditCategoryModal('{{ $cat->id }}','{{ addslashes($cat->name) }}','{{ addslashes($cat->description) }}','{{ $cat->icon }}','{{ $cat->order }}')" class="btn btn-secondary btn-sm" style="padding:.25rem .5rem">✏️</button>
                  <form method="POST" action="{{ route('admin.azkar.categories.destroy', $cat->id) }}" style="display:inline" onsubmit="return confirm('Delete category? All nested Azkar will also be removed.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="padding:.25rem .5rem">🗑️</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center">No categories found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add/Edit Modal -->
  <div id="cat-modal" class="modal-overlay">
    <div class="modal-content">
      <button class="modal-close" onclick="closeCategoryModal()">×</button>
      <h3 id="modal-title" style="margin-bottom:1rem">Add Category</h3>
      <form id="cat-form" method="POST" action="{{ route('admin.azkar.categories.store') }}">
        @csrf
        <input type="hidden" id="cat-method" name="_method" value="POST">
        <div class="form-group">
          <label for="cat_name">Category Name</label>
          <input type="text" id="cat_name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="cat_desc">Description</label>
          <textarea id="cat_desc" name="description" class="form-control"></textarea>
        </div>
        <div class="form-group-grid">
          <div class="form-group">
            <label for="cat_icon">Emoji Icon</label>
            <input type="text" id="cat_icon" name="icon" class="form-control" placeholder="📿">
          </div>
          <div class="form-group">
            <label for="cat_order">Sort Order</label>
            <input type="number" id="cat_order" name="order" class="form-control" value="0" required>
          </div>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:1rem;margin-top:1.5rem">
          <button type="button" class="btn btn-secondary" onclick="closeCategoryModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Category</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openCategoryModal() {
      document.getElementById('modal-title').textContent = 'Add Azkar Category';
      document.getElementById('cat-form').action = '{{ route("admin.azkar.categories.store") }}';
      document.getElementById('cat-method').value = 'POST';
      ['cat_name','cat_desc','cat_icon'].forEach(id => document.getElementById(id).value = '');
      document.getElementById('cat_icon').placeholder = '📿';
      document.getElementById('cat_order').value = 0;
      document.getElementById('cat-modal').classList.add('open');
    }
    function openEditCategoryModal(id, name, desc, icon, order) {
      document.getElementById('modal-title').textContent = 'Edit Azkar Category';
      document.getElementById('cat-form').action = '/admin/azkar-categories/' + id;
      document.getElementById('cat-method').value = 'PUT';
      document.getElementById('cat_name').value = name;
      document.getElementById('cat_desc').value = desc;
      document.getElementById('cat_icon').value = icon;
      document.getElementById('cat_order').value = order;
      document.getElementById('cat-modal').classList.add('open');
    }
    function closeCategoryModal() {
      document.getElementById('cat-modal').classList.remove('open');
    }
  </script>
@endsection
