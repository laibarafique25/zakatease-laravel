@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.quran.index') }}">Quranic Verses</a></li>
  <li class="active">Topics</li>
@endsection

@section('actions')
  <button onclick="openTopicModal()" class="btn btn-primary btn-sm">➕ Add Topic</button>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Quranic Topics</h1>
    <p class="page-subtitle">Organize verses by theme: Zakat, Charity, Prayer, Tawbah, Gratitude, etc.</p>
  </div>

  <div class="table-card">
    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Icon</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Verses Count</th>
            <th>Order</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($topics as $topic)
            <tr>
              <td style="font-size:1.5rem">{{ $topic->icon ?? '📖' }}</td>
              <td class="bold">{{ $topic->name }}</td>
              <td><code>{{ $topic->slug }}</code></td>
              <td>{{ $topic->verses_count ?? 0 }}</td>
              <td>{{ $topic->order }}</td>
              <td class="text-right">
                <div class="flex-gap" style="justify-content:flex-end">
                  <button onclick="openEditTopicModal('{{ $topic->id }}','{{ addslashes($topic->name) }}','{{ addslashes($topic->description) }}','{{ $topic->icon }}','{{ $topic->order }}')" class="btn btn-secondary btn-sm" style="padding:.25rem .5rem">✏️</button>
                  <form method="POST" action="{{ route('admin.quran.topics.destroy', $topic->id) }}" style="display:inline" onsubmit="return confirm('Delete this topic?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="padding:.25rem .5rem">🗑️</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center">No topics found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div id="topic-modal" class="modal-overlay">
    <div class="modal-content">
      <button class="modal-close" onclick="closeTopicModal()">×</button>
      <h3 id="modal-title" style="margin-bottom:1rem">Add Topic</h3>
      <form id="topic-form" method="POST" action="{{ route('admin.quran.topics.store') }}">
        @csrf
        <input type="hidden" id="topic-method" name="_method" value="POST">
        <div class="form-group">
          <label for="topic_name">Topic Name</label>
          <input type="text" id="topic_name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="topic_desc">Description</label>
          <textarea id="topic_desc" name="description" class="form-control"></textarea>
        </div>
        <div class="form-group-grid">
          <div class="form-group">
            <label for="topic_icon">Emoji Icon</label>
            <input type="text" id="topic_icon" name="icon" class="form-control" placeholder="📖">
          </div>
          <div class="form-group">
            <label for="topic_order">Sort Order</label>
            <input type="number" id="topic_order" name="order" class="form-control" value="0" required>
          </div>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:1rem;margin-top:1.5rem">
          <button type="button" class="btn btn-secondary" onclick="closeTopicModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Topic</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openTopicModal() {
      document.getElementById('modal-title').textContent = 'Add Quran Topic';
      document.getElementById('topic-form').action = '{{ route("admin.quran.topics.store") }}';
      document.getElementById('topic-method').value = 'POST';
      ['topic_name','topic_desc','topic_icon'].forEach(id => document.getElementById(id).value = '');
      document.getElementById('topic_order').value = 0;
      document.getElementById('topic-modal').classList.add('open');
    }
    function openEditTopicModal(id, name, desc, icon, order) {
      document.getElementById('modal-title').textContent = 'Edit Quran Topic';
      document.getElementById('topic-form').action = '/admin/quran-topics/' + id;
      document.getElementById('topic-method').value = 'PUT';
      document.getElementById('topic_name').value = name;
      document.getElementById('topic_desc').value = desc;
      document.getElementById('topic_icon').value = icon;
      document.getElementById('topic_order').value = order;
      document.getElementById('topic-modal').classList.add('open');
    }
    function closeTopicModal() {
      document.getElementById('topic-modal').classList.remove('open');
    }
  </script>
@endsection
