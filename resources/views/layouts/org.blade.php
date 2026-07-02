<!DOCTYPE html>
<html lang="en" data-theme="{{ auth()->user()->theme ?? 'light' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ZARIYAH Organization Portal</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}?v=3">
  
  <script>
    const savedTheme = localStorage.getItem('admin_theme') || '{{ auth()->user()->theme ?? 'light' }}';
    document.documentElement.setAttribute('data-theme', savedTheme);
  </script>
</head>
<body>

  <!-- LEFT SIDEBAR -->
  <aside class="admin-sidebar" style="border-right-color: var(--accent)">
    <a href="{{ url('/') }}" class="sidebar-logo">
      <div class="logo-icon" style="background: var(--accent)">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
      </div>
      <span class="logo-text" style="color: var(--accent)">ZARIYAH</span>
    </a>
    
    <ul class="sidebar-menu">
      <li class="{{ Request::is('organization/dashboard') ? 'active' : '' }}">
        <a href="{{ url('/organization/dashboard') }}">
          <span class="icon">📊</span> Org Dashboard
        </a>
      </li>
      <li class="{{ Request::is('organization/campaigns*') ? 'active' : '' }}">
        <a href="{{ url('/organization/campaigns') }}">
          <span class="icon">📢</span> Manage Campaigns
        </a>
      </li>
      <li class="{{ Request::is('organization/donations*') ? 'active' : '' }}">
        <a href="{{ url('/organization/donations') }}">
          <span class="icon">🪙</span> Recieved Donations
        </a>
      </li>
      <li class="{{ Request::is('organization/reports*') ? 'active' : '' }}">
        <a href="{{ url('/organization/reports') }}">
          <span class="icon">📈</span> Reports Center
        </a>
      </li>
      @if(auth()->user()->isAdmin())
        <hr style="border-color:var(--border); margin:1rem">
        <li>
          <a href="{{ url('/admin') }}" style="color: var(--accent)">
            <span class="icon">🛠️</span> Admin Control
          </a>
        </li>
      @endif
    </ul>
  </aside>

  <!-- MAIN WRAPPER -->
  <div class="admin-main">
    
    <!-- TOP NAVBAR -->
    <header class="admin-navbar">
      <div>
        <a href="{{ url('/') }}" style="text-decoration:none; color:var(--accent); font-weight:600; font-size:0.9rem">← Back to Website</a>
      </div>
      
      <div class="nav-actions">
        <!-- Day/Night Toggler -->
        <button class="theme-toggle-btn" onclick="toggleAdminTheme()" title="Toggle Light/Dark Theme">
          <span id="theme-btn-icon">🌙</span>
        </button>
        
        <!-- Profile menu dropdown trigger -->
        <div class="user-profile-menu" onclick="toggleProfileDropdown()">
          <div class="profile-avatar" style="border-color: var(--accent)">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
          </div>
          <div class="profile-info">
            <span class="name">{{ auth()->user()->name }}</span>
            <span class="role">{{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}</span>
          </div>
          <span class="arrow" style="font-size:0.75rem; margin-left:5px">▼</span>
          
          <!-- Dropdown items -->
          <div id="profile-dropdown" style="display:none; position:absolute; right:0; top:50px; background:var(--card); border:1px solid var(--border); border-radius:12px; box-shadow:var(--shadow-lg); width:180px; padding:0.5rem 0; z-index:110">
            <a href="{{ url('/dashboard') }}" style="display:block; padding:0.6rem 1rem; color:var(--text); text-decoration:none; font-size:0.875rem; font-weight:500; transition:background 0.2s">My Portal</a>
            <a href="{{ url('/organization/dashboard') }}" style="display:block; padding:0.6rem 1rem; color:var(--text); text-decoration:none; font-size:0.875rem; font-weight:500; transition:background 0.2s">Org Dashboard</a>
            @if(auth()->user()->isAdmin())
              <a href="{{ url('/admin') }}" style="display:block; padding:0.6rem 1rem; color:var(--text); text-decoration:none; font-size:0.875rem; font-weight:500; transition:background 0.2s">Admin Panel</a>
            @endif
            <hr style="border-color:var(--border); margin:0.25rem 0">
            <form method="POST" action="{{ route('logout') }}" style="margin:0">
              @csrf
              <button type="submit" style="display:block; width:100%; text-align:left; border:none; background:transparent; padding:0.6rem 1rem; color:var(--danger); font-size:0.875rem; font-weight:600; cursor:pointer">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </header>

    <!-- BREADCRUMBS -->
    <div class="breadcrumb-container">
      <ul class="breadcrumbs">
        <li><a href="{{ url('/organization/dashboard') }}">Organization</a></li>
        @yield('breadcrumbs')
      </ul>
      <div>
        @yield('actions')
      </div>
    </div>

    <!-- MAIN BODY CONTENT -->
    <main class="content-wrapper">
      @if(session('success'))
        <div style="background:var(--success-light); border:1px solid var(--success); color:var(--success); padding:1rem; border-radius:10px; margin-bottom:1.5rem; font-size:0.9rem; font-weight:600">
          ✓ {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div style="background:var(--danger-light); border:1px solid var(--danger); color:var(--danger); padding:1rem; border-radius:10px; margin-bottom:1.5rem; font-size:0.9rem; font-weight:600">
          ⚠️ {{ session('error') }}
        </div>
      @endif

      @yield('content')
    </main>

  </div>

  <script>
    function toggleProfileDropdown() {
      const drop = document.getElementById('profile-dropdown');
      drop.style.display = drop.style.display === 'none' ? 'block' : 'none';
    }

    window.addEventListener('click', function(e) {
      if (!e.target.closest('.user-profile-menu')) {
        const drop = document.getElementById('profile-dropdown');
        if(drop) drop.style.display = 'none';
      }
    });

    function toggleAdminTheme() {
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('admin_theme', newTheme);
      localStorage.setItem('theme', newTheme);
      
      updateThemeIcon(newTheme);

      fetch('{{ url("/admin/settings/theme") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ theme: newTheme })
      })
      .then(res => res.json())
      .catch(err => console.error(err));
    }

    function updateThemeIcon(theme) {
      const icon = document.getElementById('theme-btn-icon');
      if(icon) {
        icon.textContent = theme === 'dark' ? '☀️' : '🌙';
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      updateThemeIcon(currentTheme);
    });
  </script>

</body>
</html>
