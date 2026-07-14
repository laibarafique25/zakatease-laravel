@extends('layouts.admin')

@section('breadcrumbs')
  <li class="active">Messages & Alerts</li>
@endsection

@section('content')
  <div class="page-header">
    <h1 class="page-title">Messages & Alerts</h1>
    <p class="page-subtitle">Manage inbox, sent messages, and system broadcasts.</p>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <!-- TABS FOR MESSAGES -->
  <div class="tabs-container" style="margin-bottom: 2rem; border-bottom: 1px solid var(--border); display: flex; gap: 1rem;">
    <button class="tab-btn active" onclick="showTab('inbox')" style="padding: 10px 20px; border: none; background: none; border-bottom: 2px solid var(--emerald); color: var(--emerald); font-weight: bold; cursor: pointer;">Inbox Messages</button>
    <button class="tab-btn" onclick="showTab('sent')" style="padding: 10px 20px; border: none; background: none; color: var(--text-light); cursor: pointer;">Sent Messages</button>
    <button class="tab-btn" onclick="showTab('broadcast')" style="padding: 10px 20px; border: none; background: none; color: var(--text-light); cursor: pointer;">Broadcast Messages</button>
    <button class="tab-btn" onclick="showTab('compose')" style="padding: 10px 20px; border: none; background: none; color: var(--text-light); cursor: pointer;">Compose / Broadcast</button>
  </div>

  <!-- INBOX TAB -->
  <div id="inbox" class="tab-content">
    <div class="admin-card">
      <div class="card-header">
        <h2 class="card-title">Inbox Messages</h2>
      </div>
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>From</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse($messages as $msg)
              <tr>
                <td>{{ $msg->sender->name ?? 'System' }}</td>
                <td><strong>{{ $msg->subject }}</strong></td>
                <td>{{ Str::limit($msg->content, 50) }}</td>
                <td>{{ $msg->created_at->format('M d, Y h:i A') }}</td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-center">No inbox messages found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="pagination-wrapper">
        {{ $messages->links() }}
      </div>
    </div>
  </div>

  <!-- SENT TAB -->
  <div id="sent" class="tab-content" style="display: none;">
    <div class="admin-card">
      <div class="card-header">
        <h2 class="card-title">Sent Messages</h2>
      </div>
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>To</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse($sentMessages as $msg)
              <tr>
                <td>{{ $msg->receiver->name ?? 'User' }}</td>
                <td><strong>{{ $msg->subject }}</strong></td>
                <td>{{ Str::limit($msg->content, 50) }}</td>
                <td>{{ $msg->created_at->format('M d, Y h:i A') }}</td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-center">No sent messages found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- BROADCAST TAB -->
  <div id="broadcast" class="tab-content" style="display: none;">
    <div class="admin-card">
      <div class="card-header">
        <h2 class="card-title">Broadcast Messages</h2>
      </div>
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Target Audience</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse($broadcasts as $broadcast)
              <tr>
                <td><span class="badge {{ $broadcast->target_audience == 'all' ? 'badge-primary' : 'badge-warning' }}">{{ ucfirst($broadcast->target_audience) }}</span></td>
                <td><strong>{{ $broadcast->subject }}</strong></td>
                <td>{{ Str::limit($broadcast->content, 50) }}</td>
                <td>{{ $broadcast->created_at->format('M d, Y h:i A') }}</td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-center">No broadcasts found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- COMPOSE TAB -->
  <div id="compose" class="tab-content" style="display: none;">
    <div class="admin-card">
      <div class="card-header">
        <h2 class="card-title">Compose / Broadcast</h2>
      </div>
      <form action="{{ route('admin.messages.store') }}" method="POST" style="padding: 1.5rem;">
        @csrf
        
        <div class="form-group mb-3">
          <label>Type</label>
          <select name="type" class="form-control" onchange="toggleComposeType(this.value)" required>
            <option value="direct">Direct Message</option>
            <option value="broadcast">System Broadcast</option>
          </select>
        </div>
        
        <div class="form-group mb-3" id="userSelectGroup">
          <label>Select User</label>
          <select name="receiver_id" class="form-control">
            <option value="">-- Select a User --</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
          </select>
        </div>
        
        <div class="form-group mb-3" id="audienceSelectGroup" style="display: none;">
          <label>Target Audience</label>
          <select name="target_audience" class="form-control">
            <option value="all">All Users</option>
            <option value="donor">Donors Only</option>
            <option value="receiver">Receivers Only</option>
            <option value="organization">Organizations Only</option>
          </select>
        </div>

        <div class="form-group mb-3">
          <label>Subject</label>
          <input type="text" name="subject" class="form-control" required placeholder="Enter message subject">
        </div>

        <div class="form-group mb-4">
          <label>Message Content</label>
          <textarea name="content" class="form-control" rows="5" required placeholder="Type your message here..."></textarea>
        </div>

        <button type="submit" class="btn-primary">Send Message</button>
      </form>
    </div>
  </div>

  <script>
    function showTab(tabId) {
      document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.style.borderBottom = 'none';
        btn.style.color = 'var(--text-light)';
        btn.style.fontWeight = 'normal';
      });
      
      document.getElementById(tabId).style.display = 'block';
      event.currentTarget.style.borderBottom = '2px solid var(--emerald)';
      event.currentTarget.style.color = 'var(--emerald)';
      event.currentTarget.style.fontWeight = 'bold';
    }

    function toggleComposeType(type) {
      if (type === 'broadcast') {
        document.getElementById('userSelectGroup').style.display = 'none';
        document.getElementById('audienceSelectGroup').style.display = 'block';
      } else {
        document.getElementById('userSelectGroup').style.display = 'block';
        document.getElementById('audienceSelectGroup').style.display = 'none';
      }
    }
  </script>
@endsection
