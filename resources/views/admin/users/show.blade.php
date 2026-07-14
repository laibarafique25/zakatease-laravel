@extends('layouts.admin')

@section('breadcrumbs')
  <li><a href="{{ route('admin.users.index') }}">Users</a></li>
  <li class="active">View Profile</li>
@endsection

@section('actions')
  <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">✏️ Edit Profile</a>
@endsection

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
  <div class="alert alert-success" style="padding: 1rem 1.5rem; border-radius: 12px; background: rgba(36,138,95,0.12); color: #155e38; border: 1px solid rgba(36,138,95,0.2); margin-bottom: 1.5rem; font-weight: 500;">
    ✅ {{ session('success') }}
  </div>
@endif
@if(session('error'))
  <div class="alert alert-error" style="padding: 1rem 1.5rem; border-radius: 12px; background: rgba(182,28,28,0.12); color: #7f1d1d; border: 1px solid rgba(182,28,28,0.2); margin-bottom: 1.5rem; font-weight: 500;">
    ❌ {{ session('error') }}
  </div>
@endif

<div style="display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem; align-items: start;">

  {{-- LEFT: Main Profile Card --}}
  <div>

    {{-- Header Card --}}
    <div class="form-card" style="margin-bottom: 1.5rem;">
      <div class="profile-card-header">
        <div class="profile-card-avatar">
          {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div style="flex: 1;">
          <h2 style="margin-bottom: 6px;">{{ $user->name }}</h2>
          <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
            <span class="badge badge-info" style="text-transform: capitalize;">{{ $user->role }}</span>
            <span class="badge badge-{{ $user->status === 'active' ? 'success' : ($user->status === 'banned' ? 'danger' : 'warning') }}" style="text-transform: capitalize;">{{ $user->status }}</span>
            @if($user->is_verified)
              <span class="badge badge-success">✅ Verified</span>
            @else
              <span class="badge badge-warning">⏳ Pending Verification</span>
            @endif
          </div>
        </div>
        <div style="font-size: 2.5rem; background: rgba(36,138,95,0.08); border-radius: 16px; padding: 1rem; text-align: center; line-height: 1;">
          <div style="font-weight: 700; font-size: 2rem; color: var(--emerald);">{{ $user->trust_score }}</div>
          <div style="font-size: 0.6rem; color: var(--muted); font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase;">Trust Score</div>
        </div>
      </div>

      <div class="profile-details-grid" style="margin-top: 1.5rem;">
        <div class="profile-detail-item">
          <span class="label">Email Address</span>
          <span class="val">{{ $user->email }}</span>
        </div>
        <div class="profile-detail-item">
          <span class="label">Phone Number</span>
          <span class="val">{{ $user->phone ?? 'N/A' }}</span>
        </div>
        <div class="profile-detail-item">
          <span class="label">Preferred Theme</span>
          <span class="val" style="text-transform: capitalize;">{{ $user->theme }}</span>
        </div>
        <div class="profile-detail-item">
          <span class="label">Member Since</span>
          <span class="val">{{ $user->created_at->format('M d, Y H:i') }}</span>
        </div>
      </div>
    </div>

    {{-- Donor Profile Details --}}
    @if($user->role === 'donor' && $user->donorProfile)
      @php $dp = $user->donorProfile; @endphp
      <div class="form-card" style="margin-bottom: 1.5rem;">
        <h3 style="margin-bottom: 1.5rem; color: var(--emerald);">💚 Donor Profile</h3>
        <div class="profile-details-grid">
          <div class="profile-detail-item"><span class="label">Father's Name</span><span class="val">{{ $dp->father_name ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">CNIC</span><span class="val">{{ $dp->cnic ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Date of Birth</span><span class="val">{{ $dp->dob ? $dp->dob->format('d M, Y') : 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Gender</span><span class="val" style="text-transform: capitalize;">{{ $dp->gender ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">City</span><span class="val">{{ $dp->city ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Province</span><span class="val">{{ $dp->province ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Country</span><span class="val">{{ $dp->country ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Bank Name</span><span class="val">{{ $dp->bank_name ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Account Title</span><span class="val">{{ $dp->account_title ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">IBAN</span><span class="val">{{ $dp->iban ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Donation Method</span><span class="val">{{ $dp->preferred_donation_method ?? 'N/A' }}</span></div>
        </div>
        @if($dp->preferences)
          <div style="margin-top: 1.25rem;">
            <span class="label">Donation Preferences</span>
            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px;">
              @foreach($dp->preferences as $pref)
                <span style="padding: 4px 12px; background: rgba(36,138,95,0.1); color: var(--emerald); border-radius: 20px; font-size: 0.8rem; font-weight: 600;">{{ $pref }}</span>
              @endforeach
            </div>
          </div>
        @endif

        {{-- Documents --}}
        <hr style="border-color: var(--border); margin: 1.5rem 0;">
        <h4 style="margin-bottom: 1rem; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted);">Verification Documents</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
          @foreach(['cnic_front_path' => 'CNIC Front', 'cnic_back_path' => 'CNIC Back', 'selfie_path' => 'Selfie with CNIC'] as $field => $label)
            <div style="border: 1px solid var(--border); border-radius: 12px; padding: 1rem; text-align: center;">
              <div style="font-size: 0.75rem; font-weight: 600; color: var(--muted); margin-bottom: 8px; text-transform: uppercase;">{{ $label }}</div>
              @if($dp->$field)
                <a href="{{ Storage::url($dp->$field) }}" target="_blank" download style="display: inline-block; padding: 6px 14px; background: var(--emerald); color: white; border-radius: 8px; font-size: 0.8rem; font-weight: 600; text-decoration: none;">⬇ Download</a>
              @else
                <span style="font-size: 0.8rem; color: var(--muted);">Not uploaded</span>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    @endif

    {{-- Receiver Profile Details --}}
    @if($user->role === 'receiver' && $user->receiverProfile)
      @php $rp = $user->receiverProfile; @endphp
      <div class="form-card" style="margin-bottom: 1.5rem;">
        <h3 style="margin-bottom: 1.5rem; color: #2563eb;">🔵 Receiver Profile</h3>
        <div class="profile-details-grid">
          <div class="profile-detail-item"><span class="label">Father's Name</span><span class="val">{{ $rp->father_name ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">CNIC</span><span class="val">{{ $rp->cnic ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Date of Birth</span><span class="val">{{ $rp->dob ? $rp->dob->format('d M, Y') : 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Gender</span><span class="val" style="text-transform: capitalize;">{{ $rp->gender ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Marital Status</span><span class="val" style="text-transform: capitalize;">{{ $rp->marital_status ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Family Members</span><span class="val">{{ $rp->total_family_members ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Children</span><span class="val">{{ $rp->number_of_children ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Monthly Income</span><span class="val">{{ $rp->monthly_income ? 'PKR ' . number_format($rp->monthly_income) : 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">City</span><span class="val">{{ $rp->city ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">IBAN</span><span class="val">{{ $rp->iban ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">EasyPaisa</span><span class="val">{{ $rp->easypaisa ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">JazzCash</span><span class="val">{{ $rp->jazzcash ?? 'N/A' }}</span></div>
        </div>

        @if($rp->assistance_required)
          <div style="margin-top: 1.25rem;">
            <span class="label">Assistance Required</span>
            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px;">
              @foreach($rp->assistance_required as $item)
                <span style="padding: 4px 12px; background: rgba(37,99,235,0.1); color: #2563eb; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">{{ $item }}</span>
              @endforeach
            </div>
          </div>
        @endif

        @if($rp->reason)
          <div style="margin-top: 1.5rem; padding: 1.25rem; background: rgba(37,99,235,0.04); border-radius: 12px; border: 1px solid rgba(37,99,235,0.12);">
            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--muted); margin-bottom: 8px;">Reason for Assistance</div>
            <p style="font-size: 0.9rem; line-height: 1.7; color: var(--text);">{{ $rp->reason }}</p>
          </div>
        @endif

        <hr style="border-color: var(--border); margin: 1.5rem 0;">
        <h4 style="margin-bottom: 1rem; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted);">Verification Documents</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
          @foreach(['cnic_front_path' => 'CNIC Front', 'cnic_back_path' => 'CNIC Back', 'income_proof_path' => 'Income Proof', 'disability_cert_path' => 'Disability Cert', 'medical_report_path' => 'Medical Report', 'supporting_docs_path' => 'Supporting Docs'] as $field => $label)
            <div style="border: 1px solid var(--border); border-radius: 12px; padding: 1rem; text-align: center;">
              <div style="font-size: 0.75rem; font-weight: 600; color: var(--muted); margin-bottom: 8px; text-transform: uppercase;">{{ $label }}</div>
              @if($rp->$field)
                <a href="{{ Storage::url($rp->$field) }}" target="_blank" download style="display: inline-block; padding: 6px 14px; background: #2563eb; color: white; border-radius: 8px; font-size: 0.8rem; font-weight: 600; text-decoration: none;">⬇ Download</a>
              @else
                <span style="font-size: 0.8rem; color: var(--muted);">Not uploaded</span>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    @endif

    {{-- Organization Profile Details --}}
    @if($user->role === 'organization' && $user->organization)
      @php $org = $user->organization; @endphp
      <div class="form-card" style="margin-bottom: 1.5rem;">
        <h3 style="margin-bottom: 1.5rem; color: #9333ea;">🏛️ Organization Profile</h3>
        <div class="profile-details-grid">
          <div class="profile-detail-item"><span class="label">Organization Name</span><span class="val">{{ $org->name ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Organization Type</span><span class="val" style="text-transform: capitalize;">{{ $org->org_type ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Registration Number</span><span class="val">{{ $org->registration_number ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">NTN</span><span class="val">{{ $org->ntn ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Contact Person</span><span class="val">{{ $org->contact_person ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Website</span><span class="val">{{ $org->website ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">Bank Name</span><span class="val">{{ $org->bank_name ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">IBAN</span><span class="val">{{ $org->iban ?? 'N/A' }}</span></div>
          <div class="profile-detail-item"><span class="label">City</span><span class="val">{{ $org->city ?? 'N/A' }}</span></div>
        </div>
        @if($org->mission_statement)
          <div style="margin-top: 1.5rem; padding: 1.25rem; background: rgba(147,51,234,0.04); border-radius: 12px; border: 1px solid rgba(147,51,234,0.12);">
            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--muted); margin-bottom: 8px;">Mission Statement</div>
            <p style="font-size: 0.9rem; line-height: 1.7; color: var(--text);">{{ $org->mission_statement }}</p>
          </div>
        @endif

        <hr style="border-color: var(--border); margin: 1.5rem 0;">
        <h4 style="margin-bottom: 1rem; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted);">Organization Documents</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
          @foreach(['gov_reg_cert_path' => 'Gov. Registration', 'ngo_license_path' => 'NGO License', 'tax_cert_path' => 'Tax Certificate', 'office_images_path' => 'Office Images', 'supporting_docs_path' => 'Supporting Docs'] as $field => $label)
            <div style="border: 1px solid var(--border); border-radius: 12px; padding: 1rem; text-align: center;">
              <div style="font-size: 0.75rem; font-weight: 600; color: var(--muted); margin-bottom: 8px; text-transform: uppercase;">{{ $label }}</div>
              @if($org->$field)
                <a href="{{ Storage::url($org->$field) }}" target="_blank" download style="display: inline-block; padding: 6px 14px; background: #9333ea; color: white; border-radius: 8px; font-size: 0.8rem; font-weight: 600; text-decoration: none;">⬇ Download</a>
              @else
                <span style="font-size: 0.8rem; color: var(--muted);">Not uploaded</span>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    @endif

    {{-- Activity Log --}}
    <div class="form-card">
      <h3 style="margin-bottom: 1.5rem;">📋 Recent Actions Log</h3>
      <ul class="activity-list">
        @forelse($activities as $log)
          <li class="activity-item">
            <div class="activity-dot {{ in_array($log->action, ['delete', 'block', 'reject']) ? 'danger' : (in_array($log->action, ['create', 'approve']) ? 'success' : 'warning') }}"></div>
            <div class="activity-info">
              <span class="bold" style="font-size: 0.85rem; text-transform: capitalize;">{{ $log->action }}</span>
              <span style="font-size: 0.85rem;"> — {{ $log->description }}</span>
              <div class="activity-time">{{ $log->created_at->diffForHumans() }} (IP: {{ $log->ip_address ?? 'N/A' }})</div>
            </div>
          </li>
        @empty
          <li style="font-size: 0.85rem; color: var(--muted); padding: 1rem 0; text-align: center;">No actions logged for this user.</li>
        @endforelse
      </ul>
    </div>
  </div>

  {{-- RIGHT: Admin Actions Panel --}}
  <div style="position: sticky; top: 80px;">

    {{-- Verification Actions --}}
    <div class="form-card" style="margin-bottom: 1.5rem;">
      <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); margin-bottom: 1rem;">⚡ Verification Actions</h4>

      <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="margin-bottom: 10px;">
        @csrf
        <button type="submit" class="btn btn-success" style="width: 100%;" onclick="return confirm('Approve and verify this user?')">
          ✅ Approve & Verify
        </button>
      </form>

      <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" id="reject-form" style="margin-bottom: 10px;">
        @csrf
        <input type="text" name="reason" placeholder="Rejection reason (optional)" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 10px; margin-bottom: 8px; font-size: 0.85rem; background: transparent; color: var(--text);">
        <button type="submit" class="btn btn-danger" style="width: 100%;" onclick="return confirm('Reject this user account?')">
          ❌ Reject Application
        </button>
      </form>

      <form action="{{ route('admin.users.toggle_verification', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary btn-sm" style="width: 100%;">
          🔄 Toggle Verification
        </button>
      </form>
    </div>

    {{-- Trust Score --}}
    <div class="form-card" style="margin-bottom: 1.5rem;">
      <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); margin-bottom: 1rem;">⭐ Trust Score</h4>
      <form action="{{ route('admin.users.trust_score', $user->id) }}" method="POST">
        @csrf
        <input type="range" name="trust_score" min="0" max="100" value="{{ $user->trust_score }}" class="w-full" id="trustSlider" oninput="document.getElementById('trustValue').textContent = this.value"
          style="width: 100%; margin-bottom: 8px; accent-color: var(--emerald);">
        <div style="display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--muted); margin-bottom: 12px;">
          <span>0</span>
          <strong id="trustValue" style="color: var(--emerald);">{{ $user->trust_score }}</strong>
          <span>100</span>
        </div>
        <button type="submit" class="btn btn-primary btn-sm" style="width: 100%;">Update Score</button>
      </form>
    </div>

    {{-- Admin Notes --}}
    <div class="form-card" style="margin-bottom: 1.5rem;">
      <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); margin-bottom: 1rem;">📝 Add Admin Note</h4>
      <form action="{{ route('admin.users.add_note', $user->id) }}" method="POST">
        @csrf
        <textarea name="note" rows="3" placeholder="Write a note about this user..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 10px; margin-bottom: 10px; font-size: 0.85rem; background: transparent; color: var(--text); resize: vertical;" required></textarea>
        <button type="submit" class="btn btn-secondary btn-sm" style="width: 100%;">Add Note</button>
      </form>
    </div>

    {{-- Account Control --}}
    <div class="form-card">
      <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); margin-bottom: 1rem;">🔒 Account Control</h4>

      <form action="{{ route('admin.users.suspend', $user->id) }}" method="POST" style="margin-bottom: 10px;">
        @csrf
        <button type="submit" class="btn btn-warning btn-sm" style="width: 100%;" onclick="return confirm('Suspend this user?')">⏸ Suspend Account</button>
      </form>

      <form action="{{ route('admin.users.block', $user->id) }}" method="POST" style="margin-bottom: 10px;">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;" onclick="return confirm('Permanently block this user?')">🚫 Block Account</button>
      </form>

      <form action="{{ route('admin.users.toggle_status', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary btn-sm" style="width: 100%;">
          🔄 Toggle Active / Inactive
        </button>
      </form>
    </div>

  </div>
</div>

@endsection
