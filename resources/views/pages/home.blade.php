@extends('layouts.app')
@section('content')


<!-- HERO -->
<section class="hero" id="home">
  <div class="hero-bg">
    <div class="geo-pattern"></div>
    <div class="geo-circle"></div>
    <div class="geo-circle"></div>
    <div class="geo-circle"></div>
  </div>
  <div class="hero-content">
    <div class="hero-left">
      <div class="hero-badge">Islamic Finance Platform</div>
      <h1>Calculate Your <em>Zakat</em> Accurately in Minutes</h1>
      <p>An easy-to-use Islamic platform that helps Muslims calculate Zakat, learn Islamic teachings, track prayer times, and engage in daily remembrance.</p>
      <div class="hero-btns">
        <a href="#calculator" class="btn-primary">⚡ Calculate Zakat</a>
        <a href="#features" class="btn-secondary">Learn More →</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><h3>2.5%</h3><p>Standard Zakat Rate</p></div>
        <div class="hero-stat"><h3>100K+</h3><p>Calculations Done</p></div>
        <div class="hero-stat"><h3>50+</h3><p>Daily Ahadees</p></div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="floating-pill top"><div class="pill-icon">🕌</div>Next Prayer: Asr in 2h 14m</div>
      <div class="hero-card">
        <div class="hero-card-label">Zakat Summary</div>
        <div class="zakat-amount">PKR 18,750</div>
        <div class="zakat-sub">Annual Zakat Due (2.5%)</div>
        <div class="hero-bar-label"><span>Cash & Savings</span><span>PKR 450,000</span></div>
        <div class="hero-bar"><div class="hero-bar-fill" style="width:72%"></div></div>
        <div class="hero-bar-label"><span>Gold & Silver</span><span>PKR 280,000</span></div>
        <div class="hero-bar"><div class="hero-bar-fill" style="width:45%"></div></div>
        <div class="hero-bar-label"><span>Investments</span><span>PKR 20,000</span></div>
        <div class="hero-bar"><div class="hero-bar-fill" style="width:12%"></div></div>
        <div class="hero-nisab"><div class="nisab-dot"></div><div class="nisab-text"><strong>Nisab Reached</strong> — Zakat is obligatory</div></div>
      </div>
      <div class="floating-pill bottom"><div class="pill-icon">🌙</div>SubhanAllah × 33</div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS & FEATURES -->
<div class="section-full" id="features">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Features & Workflow</div>
      <h2>How ZakatEase Works</h2>
      <p class="section-sub">A seamless, secure, and fully transparent platform designed for your peace of mind.</p>
    </div>
    <div class="features-grid">
      <div class="feature-card reveal reveal-delay-1">
        <div class="feature-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
        <h3>1. Register</h3>
        <p>Sign up easily as a donor or a receiver to join our verified community.</p>
      </div>
      <div class="feature-card reveal reveal-delay-2">
        <div class="feature-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
        </div>
        <h3>2. Calculate Zakat</h3>
        <p>Use our smart calculator for an accurate, Shariah-compliant Zakat assessment.</p>
      </div>
      <div class="feature-card reveal reveal-delay-3">
        <div class="feature-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3>3. Verify Receiver</h3>
        <p>Ensure your donations reach fully vetted and verified individuals or organizations.</p>
      </div>
      <div class="feature-card reveal reveal-delay-1">
        <div class="feature-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        </div>
        <h3>4. Donate Securely</h3>
        <p>Send your Zakat or Sadaqah through our 100% encrypted and secure payment gateway.</p>
      </div>
      <div class="feature-card reveal reveal-delay-2">
        <div class="feature-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
        </div>
        <h3>5. Track Donations</h3>
        <p>Monitor where every penny goes with real-time updates and complete transparency.</p>
      </div>
      <div class="feature-card reveal reveal-delay-3">
        <div class="feature-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </div>
        <h3>6. Get Reminders</h3>
        <p>Receive intelligent notifications for your annual Zakat due dates and pending payments.</p>
      </div>
    </div>
  </div>
</div>
<!-- ZAKAT CALCULATOR -->

  <!-- TRUST & CREDIBILITY -->
  <section class="section" id="trust">
    <div class="section-header reveal">
      <div class="section-label">Trust & Credibility</div>
      <h2>Why Donors Trust ZARIYAH</h2>
      <p class="section-sub">Built with transparency, Shariah compliance, and secure payments as core principles.</p>
    </div>
    <div class="trust-grid reveal">
      <div class="trust-card" data-aos="fade-up">
        <div class="trust-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3>100% Transparent</h3>
        <p>Track every donation from receipt to distribution with proof of delivery and receipts.</p>
      </div>
      <div class="trust-card" data-aos="fade-up" data-aos-delay="80">
        <div class="trust-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"></path></svg>
        </div>
        <h3>Shariah Compliant</h3>
        <p>All disbursements follow strict Islamic rulings and are reviewed by our Shariah board.</p>
      </div>
      <div class="trust-card" data-aos="fade-up" data-aos-delay="160">
        <div class="trust-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        </div>
        <h3>Secure Payments</h3>
        <p>Industry-standard encryption and verified payment rails for safe donation processing.</p>
      </div>
      <div class="trust-card" data-aos="fade-up" data-aos-delay="240">
        <div class="trust-icon" style="color:var(--emerald); display:flex; align-items:center; justify-content:center;">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
        </div>
        <h3>Verified Beneficiaries</h3>
        <p>Rigorous identity and income verification ensures aid reaches genuine cases.</p>
      </div>
    </div>
  </section>

  <!-- DONOR REVIEWS CAROUSEL -->
  <section class="section" id="donor-reviews" style="background:var(--bg-card); padding-top:4rem; padding-bottom:4rem; overflow:hidden">
    <div class="section-header reveal">
      <div class="section-label">Testimonials</div>
      <h2>What Our Donors Say</h2>
      <p class="section-sub">Hear from those who have trusted ZARIYAH with their Zakat and Sadaqah.</p>
    </div>
    
    <div class="swiper donor-swiper reveal" style="padding: 20px 0;">
      <div class="swiper-wrapper">
        @foreach($donorReviews as $review)
        <div class="swiper-slide">
          <div class="review-card" style="background:var(--bg); border:1px solid var(--border); border-radius:12px; padding:24px; display:flex; flex-direction:column; gap:16px; height:100%; box-shadow:0 10px 30px rgba(0,0,0,0.05)">
            <div style="display:flex; justify-content:space-between; align-items:flex-start">
              <div style="display:flex; gap:12px; align-items:center">
                <div style="width:48px; height:48px; border-radius:50%; background:var(--emerald); color:white; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.2rem">
                  {{ strtoupper(substr($review->donor_name, 0, 1)) }}
                </div>
                <div>
                  <h4 style="margin:0; font-size:1.1rem; color:var(--text)">{{ $review->donor_name }}</h4>
                  <div style="font-size:0.85rem; color:var(--text-light)">{{ $review->city }}</div>
                </div>
              </div>
              @if($review->is_verified)
              <div style="color:var(--emerald); display:flex; align-items:center; gap:4px; font-size:0.8rem; font-weight:600; background:rgba(16,185,129,0.1); padding:4px 8px; border-radius:20px;">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg> Verified
              </div>
              @endif
            </div>
            <div style="color:var(--text-light); font-size:0.95rem; font-style:italic; line-height:1.6; flex-grow:1;">
              "{{ $review->review }}"
            </div>
            <div style="border-top:1px solid var(--border); padding-top:16px; display:flex; justify-content:space-between; align-items:center">
              <div>
                <div style="font-size:0.8rem; color:var(--text-light)">Donated</div>
                <div style="font-weight:600; color:var(--text); font-size:0.9rem">{{ $review->donation_type }} - PKR {{ number_format($review->donation_amount) }}</div>
              </div>
              <div style="color:#f59e0b; display:flex; gap:2px">
                @for($i=1; $i<=5; $i++)
                  <svg width="16" height="16" fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                @endfor
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <!-- ZAKAT CALCULATOR SHOWCASE -->
  <section class="section" id="calculator-showcase">
    <div class="section-header reveal">
      <div class="section-label">Showcase</div>
      <h2>Interactive Zakat Calculator Preview</h2>
      <p class="section-sub">Try a live mock of the calculator with animated stats and Nisab indicator.</p>
    </div>
    <div class="calc-showcase reveal">
      <div class="calc-mock">
        <div class="mock-header">
          <div>
            <div class="mock-title">Zakat Summary</div>
            <div class="mock-sub">Net Zakatable Wealth</div>
          </div>
          <div class="mock-amount">PKR <span id="mockNet">145,800</span></div>
        </div>
        <div class="mock-body">
          <div class="mock-inputs">
            <div class="mock-row"><label>Cash & Savings</label><div>PKR 450,000</div></div>
            <div class="mock-row"><label>Gold & Silver</label><div>PKR 280,000</div></div>
            <div class="mock-row"><label>Investments</label><div>PKR 20,000</div></div>
            <div class="mock-row"><label>Liabilities</label><div>PKR 200,200</div></div>
          </div>
          <div class="mock-chart"> <!-- placeholder for small sparkline / chart -->
            <div class="sparkline"></div>
          </div>
        </div>
        <div class="mock-footer">
          <div class="nisab-pill">Nisab: PKR 90,000 — <strong>Obligatory</strong></div>
          <a class="btn-primary" href="#calculator">Open Calculator</a>
        </div>
      </div>
    </div>
  </section>

  <!-- TRANSPARENCY DASHBOARD PREVIEW -->
  <div class="section-full" id="transparency">
    <div class="section">
      <div class="section-header reveal">
        <div class="section-label">Transparency</div>
        <h2>Impact & Distribution Dashboard</h2>
        <p class="section-sub">A live preview of funds collected, distributed, and pending verifications.</p>
      </div>
      <div class="dashboard-mock reveal">
        <div class="dashboard-left">
          <div class="dash-stat"><div class="dash-num" data-count="12500000">PKR 12,500,000</div><div class="dash-label">Collected</div></div>
          <div class="dash-stat"><div class="dash-num" data-count="9800000">PKR 9,800,000</div><div class="dash-label">Distributed</div></div>
          <div class="dash-stat"><div class="dash-num" data-count="1200000">PKR 1,200,000</div><div class="dash-label">Pending</div></div>
        </div>
        <div class="dashboard-right">
          <div class="progress-row"><label>Medical Campaign</label><div class="prog"><div class="prog-fill" style="width:72%"></div></div></div>
          <div class="progress-row"><label>Food Distribution</label><div class="prog"><div class="prog-fill" style="width:88%"></div></div></div>
          <div class="progress-row"><label>Education Fund</label><div class="prog"><div class="prog-fill" style="width:46%"></div></div></div>
        </div>
      </div>
    </div>
  </div>

  <!-- SUCCESS STORIES CAROUSEL -->
  <div class="section-full" id="success-stories" style="overflow:hidden">
    <div class="section">
      <div class="section-header reveal">
        <div class="section-label">Real Impact</div>
        <h2>Success Stories</h2>
        <p class="section-sub">See how your Zakat and Sadaqah are changing lives across Pakistan.</p>
      </div>
      
      <div class="swiper success-swiper reveal" style="padding: 20px 0;">
        <div class="swiper-wrapper">
          @foreach($successStories as $story)
          <div class="swiper-slide">
            <div class="story-card" style="background:var(--bg); border:1px solid var(--border); border-radius:12px; padding:24px; display:flex; flex-direction:column; gap:16px; height:100%; box-shadow:0 10px 30px rgba(0,0,0,0.05)">
              <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--border); padding-bottom:12px">
                <span style="background:rgba(16,185,129,0.1); color:var(--emerald); padding:4px 12px; border-radius:20px; font-size:0.8rem; font-weight:600; text-transform:uppercase">
                  {{ str_replace('_', ' ', $story->user_type) }}
                </span>
                @if($story->is_verified)
                  <span style="color:var(--text-light); font-size:0.8rem; display:flex; align-items:center; gap:4px">
                    <svg width="14" height="14" fill="var(--emerald)" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg> Verified Case
                  </span>
                @endif
              </div>
              
              <h3 style="margin:0; font-size:1.25rem; color:var(--text); line-height:1.4">{{ $story->title }}</h3>
              
              <p style="color:var(--text-light); font-size:0.95rem; line-height:1.6; flex-grow:1; margin:0">
                {{ Str::limit($story->story, 120) }}
              </p>
              
              <div style="background:var(--bg-card); padding:16px; border-radius:8px; display:flex; align-items:center; justify-content:space-between; margin-top:8px">
                <div style="display:flex; gap:12px; align-items:center">
                  <div style="width:40px; height:40px; border-radius:50%; background:var(--border); color:var(--text); display:flex; align-items:center; justify-content:center; font-weight:700">
                    {{ strtoupper(substr($story->full_name, 0, 1)) }}
                  </div>
                  <div>
                    <div style="font-weight:600; color:var(--text); font-size:0.9rem">{{ $story->full_name }}</div>
                    <div style="font-size:0.8rem; color:var(--text-light)">{{ $story->city }}</div>
                  </div>
                </div>
                <div style="text-align:right">
                  <div style="font-size:0.75rem; color:var(--text-light)">Received</div>
                  <div style="font-weight:700; color:var(--emerald); font-size:1rem">PKR {{ number_format($story->amount_received) }}</div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>

  <!-- IMPACT STATISTICS -->
  <section class="section" id="impact">
    <div class="section-header reveal">
      <div class="section-label">Impact</div>
      <h2>Real Impact, Measurable Results</h2>
      <p class="section-sub">Track the difference your donations make across communities.</p>
    </div>
    <div class="impact-grid reveal">
      <div class="impact-card">
        <div class="impact-num" data-target="42000">0</div>
        <div class="impact-label">Families Helped</div>
      </div>
      <div class="impact-card">
        <div class="impact-num" data-target="12500000">0</div>
        <div class="impact-label">Funds Distributed (PKR)</div>
      </div>
      <div class="impact-card">
        <div class="impact-num" data-target="9800">0</div>
        <div class="impact-label">Meals Provided</div>
      </div>
      <div class="impact-card">
        <div class="impact-num" data-target="320">0</div>
        <div class="impact-label">Cities Covered</div>
      </div>
    </div>
  </section>




<!-- CALL TO ACTION -->
  <section class="section" id="cta">
    <div class="section-header reveal">
      <div class="section-label">Act Now</div>
      <h2>Purify Wealth — Empower Lives</h2>
      <p class="section-sub">Join thousands of donors supporting verified families and community projects.</p>
    </div>
    <div class="cta-section reveal">
      <a class="btn-primary btn-cta" href="#donate">Donate Now</a>
      <a class="btn-secondary" href="#calculator">Calculate Zakat</a>
    </div>
  </section>

<!-- ZAKAT CALCULATOR -->
<div class="section" id="calculator">
  <div class="section-header reveal">
    <div class="section-label">Main Feature</div>
    <h2>Smart Zakat Calculator</h2>
    <p class="section-sub">Follow the guided steps to calculate your precise Zakat obligation for this year.</p>
  </div>

  <div class="container reveal">
    <!-- Live Market Rates Card -->
    <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:16px; padding:24px; margin-bottom:40px; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:10px;">
            <h3 style="margin:0; font-family:'Playfair Display', serif; font-size:1.5rem; color:var(--dark);">Live Market Rates</h3>
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="display:inline-block; width:8px; height:8px; background:var(--emerald); border-radius:50%; animation:pulse 2s infinite;"></span>
                <span style="font-size:0.85rem; color:var(--text-light); font-weight:600; text-transform:uppercase;">Live</span>
                @if(isset($goldRate))
                <span style="font-size:0.8rem; color:var(--text-light); margin-left:8px;">Last Updated: {{ \Carbon\Carbon::parse($goldRate->updated_at)->format('M d, Y h:i A') }}</span>
                @endif
            </div>
        </div>
        
        <div style="display:flex; gap:20px; overflow-x:auto; padding-bottom:10px; scrollbar-width:thin;">
            @if(isset($goldRate))
            <div style="min-width:160px; background:var(--bg); border:1px solid var(--border); padding:16px; border-radius:12px; text-align:center;">
                <div style="font-size:1.5rem; margin-bottom:8px;">🟡</div>
                <div style="font-weight:600; color:var(--dark); margin-bottom:4px;">Gold</div>
                <div style="font-size:0.9rem; color:var(--emerald); font-weight:700;">{{ number_format($goldRate->price) }} PKR / {{ ucfirst($goldRate->unit) }}</div>
            </div>
            @endif
            
            @if(isset($silverRate))
            <div style="min-width:160px; background:var(--bg); border:1px solid var(--border); padding:16px; border-radius:12px; text-align:center;">
                <div style="font-size:1.5rem; margin-bottom:8px;">⚪</div>
                <div style="font-weight:600; color:var(--dark); margin-bottom:4px;">Silver</div>
                <div style="font-size:0.9rem; color:var(--emerald); font-weight:700;">{{ number_format($silverRate->price) }} PKR / {{ ucfirst($silverRate->unit) }}</div>
            </div>
            @endif
            
            @if(isset($exchangeRates))
            @foreach($exchangeRates as $rate)
            <div style="min-width:140px; background:var(--bg); border:1px solid var(--border); padding:16px; border-radius:12px; text-align:center;">
                <div style="font-weight:600; color:var(--dark); margin-bottom:8px;">{{ $rate->currency_code }}</div>
                <div style="font-size:0.85rem; color:var(--text-light); margin-bottom:4px;">1 {{ $rate->currency_code }} =</div>
                <div style="font-size:0.95rem; color:var(--emerald); font-weight:700;">{{ number_format($rate->rate_to_pkr, 2) }} PKR</div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <!-- Go to Calculator Action -->
    <div style="text-align:center; padding: 20px;">
        <p style="margin-bottom: 20px; color:var(--text-light);">Use our fully dynamic, live-updated Smart Zakat Calculator to precisely measure your Zakat obligations for this year.</p>
        <a href="{{ route('calculator') }}" class="btn-primary" style="padding: 15px 30px; font-size:1.1rem; border-radius: 8px;">Open Smart Calculator ✦</a>
    </div>
  </div>
</div>

<!-- HADITH -->
<div class="section-full" id="hadith">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Daily Wisdom</div>
      <h2>Ahadees & Teachings</h2>
      <p class="section-sub">Authentic narrations in Arabic, Urdu, and English to guide your daily life.</p>
    </div>
    <div class="hadith-filters reveal">
      <button class="filter-btn active" onclick="filterHadith(this,'all')">All Topics</button>
      <button class="filter-btn" onclick="filterHadith(this,'zakat')">Zakat</button>
      <button class="filter-btn" onclick="filterHadith(this,'charity')">Charity</button>
      <button class="filter-btn" onclick="filterHadith(this,'prayer')">Prayer</button>
      <button class="filter-btn" onclick="filterHadith(this,'patience')">Patience</button>
      <button class="filter-btn" onclick="filterHadith(this,'gratitude')">Gratitude</button>
    </div>
    <div class="hadith-grid">
      <div class="hadith-card reveal reveal-delay-1" data-topic="zakat">
        <div class="hadith-arabic">إِنَّ اللَّهَ فَرَضَ زَكَاةً فِي أَمْوَالِهِمْ</div>
        <div class="hadith-urdu">بیشک اللہ نے ان کے اموال میں زکوٰۃ فرض کی ہے</div>
        <div class="hadith-english">"Indeed, Allah has made obligatory upon them the Zakat to be taken from their wealthy and given back to their poor."</div>
        <div class="hadith-ref">
          <span class="ref-tag">Bukhari & Muslim</span>
          <button class="share-btn" title="Share">↗</button>
        </div>
      </div>
      <div class="hadith-card reveal reveal-delay-2" data-topic="charity">
        <div class="hadith-arabic">الصَّدَقَةُ تُطْفِئُ الْخَطِيئَةَ كَمَا يُطْفِئُ الْمَاءُ النَّارَ</div>
        <div class="hadith-urdu">صدقہ گناہ کو اس طرح بجھاتا ہے جیسے پانی آگ کو بجھاتا ہے</div>
        <div class="hadith-english">"Charity extinguishes sin just as water extinguishes fire."</div>
        <div class="hadith-ref">
          <span class="ref-tag">Tirmidhi</span>
          <button class="share-btn" title="Share">↗</button>
        </div>
      </div>
      <div class="hadith-card reveal reveal-delay-1" data-topic="prayer">
        <div class="hadith-arabic">الصَّلَاةُ عِمَادُ الدِّينِ</div>
        <div class="hadith-urdu">نماز دین کا ستون ہے</div>
        <div class="hadith-english">"Prayer is the pillar of religion. Whoever establishes it has established religion, and whoever abandons it has destroyed religion."</div>
        <div class="hadith-ref">
          <span class="ref-tag">Al-Bayhaqi</span>
          <button class="share-btn" title="Share">↗</button>
        </div>
      </div>
      <div class="hadith-card reveal reveal-delay-2" data-topic="gratitude">
        <div class="hadith-arabic">مَنْ لَمْ يَشْكُرِ النَّاسَ لَمْ يَشْكُرِ اللَّهَ</div>
        <div class="hadith-urdu">جو لوگوں کا شکر نہیں کرتا وہ اللہ کا بھی شکر نہیں کرتا</div>
        <div class="hadith-english">"He who does not thank people does not thank Allah."</div>
        <div class="hadith-ref">
          <span class="ref-tag">Abu Dawud</span>
          <button class="share-btn" title="Share">↗</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ISLAMIC LECTURES -->
<div class="section" id="lectures">
  <div class="section-header reveal">
    <div class="section-label">Knowledge</div>
    <h2>Islamic Lectures</h2>
    <p class="section-sub">Educational content from trusted scholars to deepen your Islamic knowledge.</p>
  </div>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2rem">
    
    <!-- Video 1 -->
    <div class="feature-card reveal" style="padding:0;overflow:hidden;background:var(--bg-card);border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow)">
      <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
        <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" src="https://www.youtube.com/embed/m_KfNJ1NKmI" allowfullscreen></iframe>
      </div>
      <div style="padding:1.5rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--dark);margin-bottom:0.4rem;line-height:1.4">The Genius Zakat Method For Beginners</h3>
        <p style="font-size:0.85rem;color:var(--text-light);margin-bottom:0.75rem">Sheikh Assim Al Hakeem</p>
      </div>
    </div>
    
    <!-- Video 2 -->
    <div class="feature-card reveal reveal-delay-1" style="padding:0;overflow:hidden;background:var(--bg-card);border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow)">
      <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
        <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" src="https://www.youtube.com/embed/9FOaYt1Gbv4" allowfullscreen></iframe>
      </div>
      <div style="padding:1.5rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--dark);margin-bottom:0.4rem;line-height:1.4">Who is eligible to receive the Zakat</h3>
        <p style="font-size:0.85rem;color:var(--text-light);margin-bottom:0.75rem">Sheikh Assim Al Hakeem</p>
      </div>
    </div>
    
    <!-- Video 3 -->
    <div class="feature-card reveal reveal-delay-2" style="padding:0;overflow:hidden;background:var(--bg-card);border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow)">
      <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
        <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" src="https://www.youtube.com/embed/21pKoO9KuH4" allowfullscreen></iframe>
      </div>
      <div style="padding:1.5rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--dark);margin-bottom:0.4rem;line-height:1.4">Different percentages of Zakat</h3>
        <p style="font-size:0.85rem;color:var(--text-light);margin-bottom:0.75rem">Sheikh Assim Al Hakeem</p>
      </div>
    </div>

    <!-- Video 4 -->
    <div class="feature-card reveal" style="padding:0;overflow:hidden;background:var(--bg-card);border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow)">
      <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
        <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" src="https://www.youtube.com/embed/o9KxQuS1OdQ" allowfullscreen></iframe>
      </div>
      <div style="padding:1.5rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--dark);margin-bottom:0.4rem;line-height:1.4">Morning & evening adhkar and dhikr</h3>
        <p style="font-size:0.85rem;color:var(--text-light);margin-bottom:0.75rem">SereneIslam2024</p>
      </div>
    </div>

    <!-- Video 5 -->
    <div class="feature-card reveal reveal-delay-1" style="padding:0;overflow:hidden;background:var(--bg-card);border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow)">
      <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
        <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" src="https://www.youtube.com/embed/OtLZiVP80cE" allowfullscreen></iframe>
      </div>
      <div style="padding:1.5rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--dark);margin-bottom:0.4rem;line-height:1.4">The Most Powerful Dhikr In Ramadan</h3>
        <p style="font-size:0.85rem;color:var(--text-light);margin-bottom:0.75rem">Dr. Omar Suleiman</p>
      </div>
    </div>

    <!-- Video 6 -->
    <div class="feature-card reveal reveal-delay-2" style="padding:0;overflow:hidden;background:var(--bg-card);border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow)">
      <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
        <iframe style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" src="https://www.youtube.com/embed/GAO-8kWEMGQ" allowfullscreen></iframe>
      </div>
      <div style="padding:1.5rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--dark);margin-bottom:0.4rem;line-height:1.4">Are you paying Zakat correctly?</h3>
        <p style="font-size:0.85rem;color:var(--text-light);margin-bottom:0.75rem">Dr. Omar Suleiman</p>
      </div>
    </div>

  </div>
  <div style="text-align:center; margin-top:2rem;">
    <a href="{{ route('lectures') }}" class="btn-primary">View All Lectures</a>
  </div>
</div>

<!-- PRAYER TIMES -->
<div class="section-full" id="prayer">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Daily Schedule</div>
      <h2>Prayer Times</h2>
      <p class="section-sub">Accurate Salah timings with location detection and real-time countdowns.</p>
    </div>
    <div class="prayer-dashboard reveal">
      <div class="prayer-header" style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:2rem;gap:1rem;flex-wrap:wrap">
        <div class="prayer-date">
          <h3 id="prayerGregorianDate">Thursday, June 04, 2026</h3>
          <p id="prayerIslamicDate">13 Dhul Hijjah 1447 AH</p>
        </div>
        <div class="prayer-location" onclick="getPrayerLocation()">📍 Karachi, Pakistan · Update</div>
      </div>
      <div class="prayer-grid">
        <div class="prayer-item"><div class="prayer-icon">🌙</div><div class="prayer-name">Fajr</div><div class="prayer-time">04:22</div></div>
        <div class="prayer-item"><div class="prayer-icon">🌅</div><div class="prayer-name">Dhuhr</div><div class="prayer-time">12:06</div></div>
        <div class="prayer-item current"><div class="prayer-icon">☀️</div><div class="prayer-name">Asr</div><div class="prayer-time">15:48</div></div>
        <div class="prayer-item"><div class="prayer-icon">🌇</div><div class="prayer-name">Maghrib</div><div class="prayer-time">19:14</div></div>
        <div class="prayer-item"><div class="prayer-icon">🌃</div><div class="prayer-name">Isha</div><div class="prayer-time">20:36</div></div>
      </div>
      <div class="next-prayer-bar">
        <div>
          <div class="next-label">Next Prayer</div>
          <div class="next-name">Maghrib — 19:14</div>
        </div>
        <div class="countdown" id="prayerCountdown">3:26:04</div>
      </div>
    </div>
  </div>
</div>

<!-- TASBEEH -->
<div class="section" id="tasbeeh">
  <div class="section-header reveal">
    <div class="section-label">Daily Remembrance</div>
    <h2>Digital Tasbeeh</h2>
    <p class="section-sub">Keep track of your dhikr with our elegant digital counter.</p>
  </div>
  <div class="tasbeeh-wrapper reveal">
    <div class="tasbeeh-targets">
      <button class="target-btn" onclick="setTarget(33,this)">33</button>
      <button class="target-btn active" onclick="setTarget(99,this)">99</button>
      <button class="target-btn" onclick="setTarget(100,this)">100</button>
      <button class="target-btn" onclick="setTarget(0,this)">∞</button>
    </div>
    <div class="tasbeeh-counter" id="tasbeehCounter" onclick="incrementTasbeeh()">
      <div class="tasbeeh-ring" id="tasbeehRing"></div>
      <div class="tasbeeh-count" id="tasbeehCount">0</div>
      <div class="tasbeeh-sub" id="tasbeehSub">Tap to count</div>
    </div>
    <div class="tasbeeh-controls">
      <button class="ctrl-btn" id="soundBtn" onclick="toggleSound()">🔇 Sound Off</button>
      <button class="ctrl-btn" onclick="resetTasbeeh()">↺ Reset</button>
    </div>
    <div class="dhikr-btns">
      <button class="dhikr-btn" onclick="setDhikr('سُبْحَانَ اللَّه','SubhanAllah')"><span class="dhikr-arabic">سُبْحَانَ اللَّه</span>SubhanAllah</button>
      <button class="dhikr-btn" onclick="setDhikr('الْحَمْدُ لِلَّه','Alhamdulillah')"><span class="dhikr-arabic">الْحَمْدُ لِلَّه</span>Alhamdulillah</button>
      <button class="dhikr-btn" onclick="setDhikr('اللَّهُ أَكْبَر','Allahu Akbar')"><span class="dhikr-arabic">اللَّهُ أَكْبَر</span>Allahu Akbar</button>
      <button class="dhikr-btn" onclick="setDhikr('أَسْتَغْفِرُ اللَّه','Astaghfirullah')"><span class="dhikr-arabic">أَسْتَغْفِرُ اللَّه</span>Astaghfirullah</button>
      <button class="dhikr-btn" onclick="setDhikr('لَا إِلَٰهَ إِلَّا اللَّه','La ilaha illallah')"><span class="dhikr-arabic">لَا إِلَٰهَ إِلَّا اللَّه</span>La ilaha illallah</button>
      <button class="dhikr-btn" onclick="setDhikr('بِسْمِ اللَّه','Bismillah')"><span class="dhikr-arabic">بِسْمِ اللَّه</span>Bismillah</button>
    </div>
  </div>
</div>

<!-- FAQ -->
<div class="section-full" id="faq">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Knowledge Center</div>
      <h2>Zakat FAQ</h2>
      <p class="section-sub">Common questions about Zakat answered with clarity and precision.</p>
    </div>
    <div class="faq-list">
      <div class="faq-item reveal">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>What is Zakat and who is it obligatory upon?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>Zakat is the third pillar of Islam — a mandatory charitable contribution. It is obligatory upon every Muslim who possesses wealth above the Nisab threshold for a full lunar year. It applies to gold, silver, cash, trade goods, and certain other assets.</p></div>
      </div>
      <div class="faq-item reveal reveal-delay-1">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>What is Nisab and what is the current threshold?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>Nisab is the minimum amount of wealth a Muslim must possess before Zakat becomes obligatory. It equals the value of 87.48g of gold or 612.36g of silver. The lower of the two values (typically silver) is used as the threshold. In 2026 PKR terms, this is approximately PKR 85,000–95,000.</p></div>
      </div>
      <div class="faq-item reveal reveal-delay-2">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>How much Zakat is due and how is it calculated?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>Zakat is 2.5% of your total zakatable wealth (assets minus liabilities) if it exceeds the Nisab for a full Islamic lunar year (Hawl). Use our calculator above to compute your exact obligation in minutes.</p></div>
      </div>
      <div class="faq-item reveal reveal-delay-1">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>Who can receive Zakat?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>The Quran (9:60) specifies eight categories: the poor (Fuqara), the needy (Masakin), Zakat administrators, those whose hearts are to be reconciled, those in bondage, debtors, in the cause of Allah (Fi Sabilillah), and stranded travelers.</p></div>
      </div>
      <div class="faq-item reveal reveal-delay-2">
        <div class="faq-q" onclick="toggleFaq(this)">
          <h4>Is Zakat due on investments and business assets?</h4>
          <div class="faq-arrow">▼</div>
        </div>
        <div class="faq-a"><p>Yes. Business inventory is zakatable at market value. Stocks are zakatable on their zakatable portion (liquid assets of the company). Mutual funds follow the same principle. Fixed assets like machinery used in production are generally not zakatable.</p></div>
      </div>
    </div>
  </div>
</div>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.donor-swiper', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 4500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        640: { slidesPerView: 1, spaceBetween: 20 },
        768: { slidesPerView: 2, spaceBetween: 30 },
        1024: { slidesPerView: 3, spaceBetween: 40 },
      }
    });

    new Swiper('.success-swiper', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        640: { slidesPerView: 1, spaceBetween: 20 },
        768: { slidesPerView: 2, spaceBetween: 30 },
        1024: { slidesPerView: 3, spaceBetween: 40 },
      }
    });
  });
</script>

@endsection

