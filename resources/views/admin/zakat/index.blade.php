@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Zakat Content</li>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Zakat Content Management</h1>
    <p class="page-subtitle">Configure asset rules, adjust gold & silver Nisab values in PKR, and manage calculator FAQs.</p>
  </div>

  <!-- NISAB CONFIGURATION PANELS -->
  <div class="card-grid" style="margin-bottom: 2rem">
    @foreach($nisabs as $nisab)
      <div class="admin-card">
        <h3>Nisab threshold: {{ ucfirst($nisab->type) }}</h3>
        <p class="page-subtitle" style="margin-bottom:1rem">Weight equivalent: {{ $nisab->weight_grams }} grams.</p>
        
        <form method="POST" action="{{ route('admin.zakat.nisab.update', $nisab->id) }}">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="weight_{{ $nisab->id }}">Nisab weight (grams)</label>
            <input type="number" step="0.001" id="weight_{{ $nisab->id }}" name="weight_grams" class="form-control" value="{{ $nisab->weight_grams }}" required>
          </div>
          <div class="form-group">
            <label for="val_{{ $nisab->id }}">PKR value per gram</label>
            <input type="number" step="0.01" id="val_{{ $nisab->id }}" name="value_pkr" class="form-control" value="{{ $nisab->value_pkr }}" required>
          </div>
          <p class="activity-time" style="margin-bottom:1rem">Last updated by: {{ $nisab->updated_by ?? 'System' }}</p>
          <button type="submit" class="btn btn-primary btn-sm">Update Nisab</button>
        </form>
      </div>
    @endforeach
  </div>

  <!-- ASSET RULES PANEL -->
  <div class="table-card">
    <div class="table-header">
      <h3>Zakat Asset Rules</h3>
    </div>
    <div style="padding: 1.5rem">
      @foreach($rules as $rule)
        <div style="background:var(--bg); border:1px solid var(--border); border-radius:12px; padding:1.5rem; margin-bottom:1.5rem">
          <form method="POST" action="{{ route('admin.zakat.rules.update', $rule->id) }}">
            @csrf
            @method('PUT')
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem">
              <h4 style="text-transform: uppercase; color:var(--accent)">{{ $rule->title }} ({{ $rule->asset_type }})</h4>
              <div style="display:flex; align-items:center; gap:8px">
                <input type="checkbox" name="is_active" value="1" {{ $rule->is_active ? 'checked' : '' }}> Active
                <input type="number" name="order" class="form-input" style="width:60px; height:28px" value="{{ $rule->order }}" title="Sort Order">
              </div>
            </div>
            
            <div class="form-group">
              <label>Calculation guidelines</label>
              <textarea name="content" class="form-control" required style="min-height:90px">{{ $rule->content }}</textarea>
            </div>
            
            <div class="form-group-grid">
              <div class="form-group">
                <label>Islamic Reference (Quran/Hadith)</label>
                <textarea name="islamic_references" class="form-control" style="min-height:60px">{{ $rule->islamic_references }}</textarea>
              </div>
              <div class="form-group">
                <label>Scholarly Explanations</label>
                <textarea name="scholarly_explanations" class="form-control" style="min-height:60px">{{ $rule->scholarly_explanations }}</textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-secondary btn-sm">Save Rules</button>
          </form>
        </div>
      @endforeach
    </div>
  </div>

  <!-- FAQ SECTION -->
  <div class="table-card" style="margin-top:2rem">
    <div class="table-header">
      <h3>Zakat FAQs</h3>
      <button onclick="openFaqModal()" class="btn btn-primary btn-sm">Add FAQ</button>
    </div>
    
    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Question</th>
            <th>Category</th>
            <th>Order</th>
            <th>Active</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($faqs as $faq)
            <tr>
              <td class="bold">{{ $faq->question }}</td>
              <td>{{ $faq->category }}</td>
              <td>{{ $faq->order }}</td>
              <td><span class="badge badge-{{ $faq->is_active ? 'success' : 'warning' }}">{{ $faq->is_active ? 'Yes' : 'No' }}</span></td>
              <td class="text-right">
                <div class="flex-gap" style="justify-content: flex-end">
                  <button onclick="openEditFaqModal('{{ $faq->id }}', '{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}', '{{ $faq->category }}', '{{ $faq->order }}', '{{ $faq->is_active }}')" class="btn btn-secondary btn-sm" style="padding: 0.25rem 0.5rem">✏️</button>
                  <form method="POST" action="{{ route('admin.zakat.faqs.destroy', $faq->id) }}" style="display:inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="padding: 0.25rem 0.5rem">🗑️</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">No FAQs registered.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add/Edit FAQ Modal -->
  <div id="faq-modal" class="modal-overlay">
    <div class="modal-content">
      <button class="modal-close" onclick="closeFaqModal()">×</button>
      <h3 id="modal-title" style="margin-bottom:1rem">Add FAQ</h3>
      <form id="faq-form" method="POST" action="{{ route('admin.zakat.faqs.store') }}">
        @csrf
        <input type="hidden" id="faq-method" name="_method" value="POST">
        
        <div class="form-group">
          <label for="question">Question</label>
          <input type="text" id="question" name="question" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="answer">Answer</label>
          <textarea id="answer" name="answer" class="form-control" required></textarea>
        </div>

        <div class="form-group-grid">
          <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="order">Sort Order</label>
            <input type="number" id="order" name="order" class="form-control" required>
          </div>
        </div>

        <div class="form-group" id="faq-active-group" style="display:none">
          <div style="display:flex; align-items:center; gap:8px">
            <input type="checkbox" id="faq_is_active" name="is_active" value="1">
            <label for="faq_is_active" style="margin:0">Active FAQ</label>
          </div>
        </div>

        <div style="display:flex; justify-content: flex-end; gap: 1rem; margin-top:1.5rem">
          <button type="button" class="btn btn-secondary" onclick="closeFaqModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">Save FAQ</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openFaqModal() {
      document.getElementById('modal-title').textContent = 'Add FAQ';
      document.getElementById('faq-form').action = '{{ route("admin.zakat.faqs.store") }}';
      document.getElementById('faq-method').value = 'POST';
      document.getElementById('question').value = '';
      document.getElementById('answer').value = '';
      document.getElementById('category').value = 'General';
      document.getElementById('order').value = '0';
      document.getElementById('faq-active-group').style.display = 'none';
      document.getElementById('faq-modal').classList.add('open');
    }

    function openEditFaqModal(id, question, answer, category, order, active) {
      document.getElementById('modal-title').textContent = 'Edit FAQ';
      document.getElementById('faq-form').action = '/admin/zakat/faqs/' + id;
      document.getElementById('faq-method').value = 'PUT';
      document.getElementById('question').value = question;
      document.getElementById('answer').value = answer;
      document.getElementById('category').value = category;
      document.getElementById('order').value = order;
      document.getElementById('faq-active-group').style.display = 'block';
      document.getElementById('faq_is_active').checked = active == '1';
      document.getElementById('faq-modal').classList.add('open');
    }

    function closeFaqModal() {
      document.getElementById('faq-modal').classList.remove('open');
    }
  </script>
@endsection
