<!DOCTYPE html>
<html lang="en" data-theme="{{ auth()->user()->theme ?? 'light' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ZARIYAH Admin Panel</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}?v=3">
  
  <script>
    // Inline script to prevent theme flash
    const savedTheme = localStorage.getItem('admin_theme') || '{{ auth()->user()->theme ?? 'light' }}';
    document.documentElement.setAttribute('data-theme', savedTheme);
  </script>
</head>
<body>

  <!-- LEFT SIDEBAR -->
  <aside class="admin-sidebar">
    <a href="{{ url('/') }}" class="sidebar-logo">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
      </div>
      <span class="logo-text">ZARIYAH</span>
    </a>
    
    <ul class="sidebar-menu">
      <li class="{{ Request::is('admin') ? 'active' : '' }}">
        <a href="{{ url('/admin') }}">
          <span class="icon">📊</span> Dashboard
        </a>
      </li>
      <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
        <a href="{{ url('/admin/users') }}">
          <span class="icon">👥</span> Users
        </a>
      </li>
      <li class="{{ Request::is('admin/organizations*') ? 'active' : '' }}">
        <a href="{{ url('/admin/organizations') }}">
          <span class="icon">🏢</span> Organizations
        </a>
      </li>
      <li class="{{ Request::is('admin/campaigns*') ? 'active' : '' }}">
        <a href="{{ url('/admin/campaigns') }}">
          <span class="icon">📢</span> Campaigns
        </a>
      </li>
      <li class="{{ Request::is('admin/donations*') ? 'active' : '' }}">
        <a href="{{ url('/admin/donations') }}">
          <span class="icon">💰</span> Donations
        </a>
      </li>
      <li class="{{ Request::is('admin/zakat*') ? 'active' : '' }}">
        <a href="{{ url('/admin/zakat') }}">
          <span class="icon">🧮</span> Zakat Calculator
        </a>
      </li>
      <li class="{{ Request::is('admin/prayers*') ? 'active' : '' }}">
        <a href="{{ url('/admin/prayers') }}">
          <span class="icon">🕌</span> Prayer Management
        </a>
      </li>
      <li class="{{ Request::is('admin/hadith*') ? 'active' : '' }}">
        <a href="{{ url('/admin/hadith') }}">
          <span class="icon">📚</span> Hadith Collection
        </a>
      </li>
      <li class="{{ Request::is('admin/azkar*') ? 'active' : '' }}">
        <a href="{{ url('/admin/azkar') }}">
          <span class="icon">📿</span> Azkar Collection
        </a>
      </li>
      <li class="{{ Request::is('admin/quran*') ? 'active' : '' }}">
        <a href="{{ url('/admin/quran') }}">
          <span class="icon">📖</span> Quranic Verses
        </a>
      </li>
      <li class="{{ Request::is('admin/ai*') ? 'active' : '' }}">
        <a href="{{ url('/admin/ai') }}">
          <span class="icon">🤖</span> AI Knowledge Base
        </a>
      </li>
      <li class="{{ Request::is('admin/messages*') ? 'active' : '' }}">
        <a href="{{ url('/admin/messages') }}">
          <span class="icon">✉️</span> Messages & Alerts
        </a>
      </li>
      <li class="{{ Request::is('admin/reports*') ? 'active' : '' }}">
        <a href="{{ url('/admin/reports') }}">
          <span class="icon">📈</span> Reports Center
        </a>
      </li>
      <li class="{{ Request::is('admin/activity-logs*') ? 'active' : '' }}">
        <a href="{{ url('/admin/activity-logs') }}">
          <span class="icon">📋</span> Activity Logs
        </a>
      </li>
      <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
        <a href="{{ url('/admin/settings') }}">
          <span class="icon">⚙️</span> Settings
        </a>
      </li>
    </ul>
  </aside>

  <!-- MAIN WRAPPER -->
  <div class="admin-main">
    
    <!-- TOP NAVBAR -->
    <header class="admin-navbar">
      <div class="nav-search">
        <span>🔍</span>
        <input type="text" id="global-search" placeholder="Search system resources...">
      </div>
      
      <div class="nav-actions">
        <!-- Day/Night Toggler -->
        <button class="theme-toggle-btn" onclick="toggleAdminTheme()" title="Toggle Light/Dark Theme">
          <span id="theme-btn-icon">🌙</span>
        </button>

        <!-- Notification Bell -->
        <button class="nav-icon-btn" title="View Alerts" onclick="window.location.href='{{ url('/admin/messages') }}'">
          <span>🔔</span>
        </button>
        
        <!-- Profile menu dropdown trigger -->
        <div class="user-profile-menu" onclick="toggleProfileDropdown()">
          <div class="profile-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
          </div>
          <div class="profile-info">
            <span class="name">{{ auth()->user()->name }}</span>
            <span class="role">{{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}</span>
          </div>
          <span class="arrow" style="font-size:0.75rem; margin-left:5px">▼</span>
          
          <!-- Dropdown items -->
          <div id="profile-dropdown" style="display:none; position:absolute; right:0; top:50px; background:var(--card); border:1px solid var(--border); border-radius:12px; box-shadow:var(--shadow-lg); width:180px; padding:0.5rem 0; z-index:110">
            <a href="{{ url('/dashboard') }}" style="display:block; padding:0.6rem 1rem; color:var(--text); text-decoration:none; font-size:0.875rem; font-weight:500; transition:background 0.2s">User Panel</a>
            @if(auth()->user()->role === 'organization')
              <a href="{{ url('/organization/dashboard') }}" style="display:block; padding:0.6rem 1rem; color:var(--text); text-decoration:none; font-size:0.875rem; font-weight:500; transition:background 0.2s">Org Panel</a>
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
        <li><a href="{{ url('/admin') }}">Admin</a></li>
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
    // Profile dropdown
    function toggleProfileDropdown() {
      const drop = document.getElementById('profile-dropdown');
      drop.style.display = drop.style.display === 'none' ? 'block' : 'none';
    }

    // Close profile dropdown when clicking outside
    window.addEventListener('click', function(e) {
      if (!e.target.closest('.user-profile-menu')) {
        const drop = document.getElementById('profile-dropdown');
        if(drop) drop.style.display = 'none';
      }
    });

    // Theme toggler
    function toggleAdminTheme() {
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      // Update HTML state
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('admin_theme', newTheme);
      localStorage.setItem('theme', newTheme); // synchronize with front-end
      
      // Update Button icon
      updateThemeIcon(newTheme);

      // Save to database asynchronously
      fetch('{{ url("/admin/settings/theme") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ theme: newTheme })
      })
      .then(res => res.json())
      .catch(err => console.error("Could not save theme to database: ", err));
    }

    function updateThemeIcon(theme) {
      const icon = document.getElementById('theme-btn-icon');
      if(icon) {
        icon.textContent = theme === 'dark' ? '☀️' : '🌙';
      }
    }

    // Set initial theme icon
    document.addEventListener('DOMContentLoaded', () => {
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      updateThemeIcon(currentTheme);
    });
  </script>

</body>
</html>
