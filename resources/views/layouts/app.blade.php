<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ZARIYAH – Purify Wealth. Empower Lives.</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=2">
  <script>
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
      document.documentElement.setAttribute('data-theme', savedTheme);
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      document.documentElement.setAttribute('data-theme', 'dark');
    }
  </script>
</head>
<body>

<!-- PRELOADER -->
<div id="preloader" aria-hidden="true">
  <div class="preloader-inner" id="cinematicLoader">
    <div class="preload-text">LOADING</div>
    <div class="preloader-circle" id="preloaderCircle"></div>
    <div class="preloader-logo" id="preloaderLogo">
      <div class="logo-text">ZARIYAH</div>
      <div class="logo-tag">Purify Wealth. Empower Lives.</div>
    </div>
  </div>
</div>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
  <a href="{{ url('/') }}" class="nav-logo">
    <div class="nav-logo-icon">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
    </div>
    <span class="nav-logo-text">ZARIYAH</span>
  </a>
  <ul class="nav-links">
    <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
    <li><a href="{{ url('/calculator') }}" class="{{ Request::is('calculator') ? 'active' : '' }}">Calculator</a></li>
    <li><a href="{{ url('/campaigns') }}" class="{{ Request::is('campaigns') ? 'active' : '' }}">Campaigns</a></li>
    <li><a href="{{ url('/transparency') }}" class="{{ Request::is('transparency') ? 'active' : '' }}">Transparency</a></li>
    <li><a href="{{ url('/apply') }}" class="{{ Request::is('apply') ? 'active' : '' }}">Apply For Help</a></li>
    <li><a href="{{ url('/faq') }}" class="{{ Request::is('faq') ? 'active' : '' }}">FAQ</a></li>
    <li><a href="{{ url('/contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
  </ul>
  <div class="nav-right">
    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle Dark Mode">🌙</button>
    @auth
      <div style="display:flex;align-items:center;gap:1rem">
        <span style="color:var(--text-light);font-size:0.95rem">Hello, <strong>{{ Auth::user()->name }}</strong></span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
          @csrf
          <button type="submit" class="btn-secondary" style="cursor:pointer">Logout</button>
        </form>
      </div>
    @else
      <a href="{{ url('/login') }}" class="btn-secondary">Login</a>
      <a href="{{ url('/signup') }}" class="btn-primary">Sign Up</a>
    @endauth
    <div class="hamburger" onclick="toggleMenu()">
      <span></span><span></span><span></span>
    </div>
  </div>
</nav>

<!-- MOBILE MENU -->
<div class="mobile-menu" id="mobileMenu">
  <a href="{{ url('/') }}" onclick="closeMenu()">Home</a>
  <a href="{{ url('/calculator') }}" onclick="closeMenu()">Zakat Calculator</a>
  <a href="{{ url('/campaigns') }}" onclick="closeMenu()">Campaigns</a>
  <a href="{{ url('/transparency') }}" onclick="closeMenu()">Transparency</a>
  <a href="{{ url('/apply') }}" onclick="closeMenu()">Apply For Help</a>
  <a href="{{ url('/faq') }}" onclick="closeMenu()">FAQ</a>
  <a href="{{ url('/contact') }}" onclick="closeMenu()">Contact</a>
  @auth
    <div style="border-top:1px solid var(--border);margin-top:1rem;padding-top:1rem">
      <p style="color:var(--text-light);margin-bottom:0.75rem">Hello, <strong>{{ Auth::user()->name }}</strong></p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="color:var(--emerald);text-decoration:none;cursor:pointer;background:none;border:none;font-size:1rem">Logout</button>
      </form>
    </div>
  @else
    <a href="{{ url('/login') }}" onclick="closeMenu()">Login</a>
    <a href="{{ url('/signup') }}" onclick="closeMenu()">Sign Up</a>
  @endauth
</div>

@yield('content')

<!-- FOOTER -->
<footer id="contact">
  <div class="footer-inner">
    <div class="footer-grid">
      <div class="footer-brand">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:0.75rem">
          <div class="nav-logo-icon" style="width:34px;height:34px">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;fill:white"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>
          </div>
          <span style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:white">ZARIYAH</span>
        </div>
        <p>Purify Wealth. Empower Lives.</p>
      </div>
      <div class="footer-col">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="{{ url('/campaigns') }}">Campaigns</a></li>
          <li><a href="{{ url('/transparency') }}">Transparency</a></li>
          <li><a href="{{ url('/apply') }}">Apply For Help</a></li>
          <li><a href="{{ url('/calculator') }}">Zakat Calculator</a></li>
          <li><a href="{{ url('/hadith') }}">Daily Hadith</a></li>
          <li><a href="{{ url('/prayer') }}">Prayer Times</a></li>
          <li><a href="{{ url('/tasbeeh') }}">Tasbeeh</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Islamic Resources</h4>
        <ul>
          <li><a href="#">Quran Online</a></li>
          <li><a href="#">Hadith Collections</a></li>
          <li><a href="#">Islamic Calendar</a></li>
          <li><a href="#">Qibla Direction</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Contact Us</h4>
        <ul>
          <li><a href="mailto:info@zakatease.com">info@zakatease.com</a></li>
          <li><a href="#">Karachi, Pakistan</a></li>
          <li><a href="{{ url('/faq') }}">Help & FAQ</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2026 Zakat Ease. Built to simplify Zakat and strengthen Islamic awareness.</p>
      <div class="social-links">
        <a href="#" class="social-link">𝕏</a>
        <a href="#" class="social-link">in</a>
        <a href="#" class="social-link">▶</a>
        <a href="#" class="social-link">📷</a>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script src="{{ asset('assets/js/app.js') }}?v=2"></script>
<script>
  window.addEventListener('load', function(){
    setTimeout(function(){
      var p = document.getElementById('preloader');
      if(p){
        p.classList.add('hide');
        p.style.pointerEvents='none';
        setTimeout(function(){ if(p.parentNode) p.parentNode.removeChild(p); }, 800);
      }
      sessionStorage.setItem('siteVisited','1');
      document.querySelectorAll('.reveal').forEach(function(el){ el.classList.add('visible'); });
    }, 3500);
  });
</script>

<!-- NOOR AI COPILOT -->
<x-ai-copilot />

</body>
</html>

