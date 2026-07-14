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
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg></span> Dashboard
        </a>
      </li>
      <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
        <a href="{{ url('/admin/users') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></span> Users
        </a>
      </li>
      <li class="{{ Request::is('admin/organizations*') ? 'active' : '' }}">
        <a href="{{ url('/admin/organizations') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></span> Organizations
        </a>
      </li>
      <li class="{{ Request::is('admin/campaigns*') ? 'active' : '' }}">
        <a href="{{ url('/admin/campaigns') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg></span> Campaigns
        </a>
      </li>
      <li class="{{ Request::is('admin/donations*') ? 'active' : '' }}">
        <a href="{{ url('/admin/donations') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span> Donations
        </a>
      </li>
      <li class="{{ Request::is('admin/zakat*') ? 'active' : '' }}">
        <a href="{{ url('/admin/zakat') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg></span> Zakat Calculator
        </a>
      </li>
      <li class="{{ Request::is('admin/prayers*') ? 'active' : '' }}">
        <a href="{{ url('/admin/prayers') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></span> Prayer Management
        </a>
      </li>
      <li class="{{ Request::is('admin/market-rates*') ? 'active' : '' }}">
        <a href="{{ url('/admin/market-rates') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span> Market Rates
        </a>
      </li>
      <li class="{{ Request::is('admin/hadith*') ? 'active' : '' }}">
        <a href="{{ url('/admin/hadith') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></span> Hadith Collection
        </a>
      </li>
      <li class="{{ Request::is('admin/azkar*') ? 'active' : '' }}">
        <a href="{{ url('/admin/azkar') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg></span> Azkar Collection
        </a>
      </li>
      <li class="{{ Request::is('admin/quran*') ? 'active' : '' }}">
        <a href="{{ url('/admin/quran') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></span> Quranic Verses
        </a>
      </li>
      <li class="{{ Request::is('admin/ai*') ? 'active' : '' }}">
        <a href="{{ url('/admin/ai') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg></span> AI Knowledge Base
        </a>
      </li>
      <li class="{{ Request::is('admin/messages*') ? 'active' : '' }}">
        <a href="{{ url('/admin/messages') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></span> Messages & Alerts
        </a>
      </li>
      <li class="{{ Request::is('admin/reports*') ? 'active' : '' }}">
        <a href="{{ url('/admin/reports') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg></span> Reports Center
        </a>
      </li>
      <li class="{{ Request::is('admin/activity-logs*') ? 'active' : '' }}">
        <a href="{{ url('/admin/activity-logs') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg></span> Activity Logs
        </a>
      </li>
      <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
        <a href="{{ url('/admin/settings') }}">
          <span class="icon"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></span> Settings
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
