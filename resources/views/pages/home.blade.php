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

<!-- FEATURES -->
<div class="section-full" id="features">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Everything You Need</div>
      <h2>A Complete Islamic Platform</h2>
      <p class="section-sub">All the tools a Muslim needs, thoughtfully designed in one beautiful application.</p>
    </div>
    <div class="features-grid">
      <div class="feature-card reveal reveal-delay-1">
        <div class="feature-icon">🧮</div>
        <h3>Smart Zakat Calculator</h3>
        <p>Calculate assets, liabilities, and payable Zakat with our step-by-step guided calculator.</p>
      </div>
      <div class="feature-card reveal reveal-delay-2">
        <div class="feature-icon">🕌</div>
        <h3>Prayer Times</h3>
        <p>Accurate daily prayer schedule based on your exact location with countdown to next Salah.</p>
      </div>
      <div class="feature-card reveal reveal-delay-3">
        <div class="feature-icon">📿</div>
        <h3>Digital Tasbeeh</h3>
        <p>Interactive tasbeeh counter with custom targets, sound, and vibration support.</p>
      </div>
      <div class="feature-card reveal reveal-delay-1">
        <div class="feature-icon">📖</div>
        <h3>Daily Hadith</h3>
        <p>New authentic hadith every day in Arabic, Urdu, and English with references.</p>
      </div>
      <div class="feature-card reveal reveal-delay-2">
        <div class="feature-icon">🎥</div>
        <h3>Islamic Lectures</h3>
        <p>Curated educational video content from trusted scholars across the Muslim world.</p>
      </div>
      <div class="feature-card reveal reveal-delay-3">
        <div class="feature-icon">📚</div>
        <h3>Zakat Guide</h3>
        <p>Learn who must pay Zakat, who can receive it, and detailed rulings on all asset types.</p>
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
        <div class="trust-icon">✔️</div>
        <h3>100% Transparent</h3>
        <p>Track every donation from receipt to distribution with proof of delivery and receipts.</p>
      </div>
      <div class="trust-card" data-aos="fade-up" data-aos-delay="80">
        <div class="trust-icon">🕋</div>
        <h3>Shariah Compliant</h3>
        <p>All disbursements follow strict Islamic rulings and are reviewed by our Shariah board.</p>
      </div>
      <div class="trust-card" data-aos="fade-up" data-aos-delay="160">
        <div class="trust-icon">🔒</div>
        <h3>Secure Payments</h3>
        <p>Industry-standard encryption and verified payment rails for safe donation processing.</p>
      </div>
      <div class="trust-card" data-aos="fade-up" data-aos-delay="240">
        <div class="trust-icon">✅</div>
        <h3>Verified Beneficiaries</h3>
        <p>Rigorous identity and income verification ensures aid reaches genuine cases.</p>
      </div>
    </div>
  </section>

  <!-- PLATFORM OVERVIEW -->
  <div class="section-full" id="platform-overview">
    <div class="section">
      <div class="section-header reveal">
        <div class="section-label">Platform</div>
        <h2>ZARIYAH Ecosystem</h2>
        <p class="section-sub">A complete suite combining finance, community, verification, and impact tracking.</p>
      </div>
      <div class="platform-grid reveal">
        <div class="platform-card" data-aos="fade-up">
          <div class="platform-icon">🧮</div>
          <h4>Zakat Calculator</h4>
          <p>Multi-asset calculations, live Nisab updates, and printable reports.</p>
        </div>
        <div class="platform-card" data-aos="fade-up" data-aos-delay="80">
          <div class="platform-icon">🎯</div>
          <h4>Donation Campaigns</h4>
          <p>Create and support campaigns for immediate relief and long-term programs.</p>
        </div>
        <div class="platform-card" data-aos="fade-up" data-aos-delay="160">
          <div class="platform-icon">📊</div>
          <h4>Transparency Dashboard</h4>
          <p>Real-time distribution insights, receipts, and impact reporting.</p>
        </div>
        <div class="platform-card" data-aos="fade-up" data-aos-delay="240">
          <div class="platform-icon">🤝</div>
          <h4>Community Hub</h4>
          <p>Connect with volunteers, beneficiaries, and local chapters.</p>
        </div>
        <div class="platform-card" data-aos="fade-up" data-aos-delay="320">
          <div class="platform-icon">📿</div>
          <h4>Daily Azkar</h4>
          <p>Personalized reminders, morning & evening Azkar, and progress tracking.</p>
        </div>
        <div class="platform-card" data-aos="fade-up" data-aos-delay="400">
          <div class="platform-icon">📝</div>
          <h4>Beneficiary Applications</h4>
          <p>Apply, review, verify, and approve — all with audit trails.</p>
        </div>
      </div>
    </div>
  </div>

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

  <!-- HOW IT WORKS -->
  <div class="section-full" id="how">
    <div class="section">
      <div class="section-header reveal">
        <div class="section-label">How ZARIYAH Works</div>
        <h2>Simple Steps to Create Impact</h2>
        <p class="section-sub">From calculation to distribution — an audited, transparent workflow.</p>
      </div>
      <div class="timeline reveal">
        <div class="timeline-step" data-aos="fade-right">
          <div class="step-num">1</div>
          <h4>Calculate</h4>
          <p>Use our smart calculator to determine your Zakat accurately.</p>
        </div>
        <div class="timeline-step" data-aos="fade-up" data-aos-delay="80">
          <div class="step-num">2</div>
          <h4>Donate</h4>
          <p>Support verified campaigns or send Zakat directly to beneficiaries.</p>
        </div>
        <div class="timeline-step" data-aos="fade-up" data-aos-delay="160">
          <div class="step-num">3</div>
          <h4>Verify</h4>
          <p>Beneficiary verification and receipt uploads ensure accountability.</p>
        </div>
        <div class="timeline-step" data-aos="fade-left" data-aos-delay="240">
          <div class="step-num">4</div>
          <h4>Distribute</h4>
          <p>Funds are distributed with monitoring and impact reports shared with donors.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- COMMUNITY & DONOR SECTIONS -->
<section class="section" id="community">
  <div class="section-header reveal">
    <div class="section-label">Community</div>
    <h2>Community Hub & Volunteer Network</h2>
    <p class="section-sub">Connect, volunteer, and support local chapters with curated activities and discussions.</p>
  </div>
  <div class="section" style="max-width:1100px;margin:0 auto;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;align-items:center">
      <div class="community-feed reveal">
        <div class="feature-card" style="padding:1rem">
          <h3>Community Discussions</h3>
          <p>Share updates, request volunteers, and coordinate local distribution.</p>
        </div>
        <div class="feature-card" style="padding:1rem;margin-top:1rem">
          <h3>Volunteer Activities</h3>
          <p>Find events near you and sign up to help with verified campaigns.</p>
        </div>
      </div>
      <div class="community-side reveal">
        <div class="feature-card" style="padding:1rem">
          <h3>Success Stories</h3>
          <p>Short highlights of lives changed through verified distributions.</p>
        </div>
        <div class="feature-card" style="padding:1rem;margin-top:1rem">
          <h3>Q&A & Resources</h3>
          <p>Ask questions, read guides, and access verified Islamic financial advice.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DAILY AZKAR (Premium) -->
<section class="section-full" id="daily-azkar">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Daily Azkar</div>
      <h2>Morning & Evening Reminders</h2>
      <p class="section-sub">Curated morning/evening Azkar with beautiful Arabic typography and easy save-to-profile features.</p>
    </div>
    <div class="azkar-grid reveal" style="display:flex;gap:1rem;justify-content:center">
      <div class="feature-card" style="max-width:420px;padding:1.25rem">
        <h3 style="font-family:'Amiri',serif;font-size:1.15rem">Morning Azkar</h3>
        <p>Short, powerful daily remembrances to begin your day with intention.</p>
      </div>
      <div class="feature-card" style="max-width:420px;padding:1.25rem">
        <h3 style="font-family:'Amiri',serif;font-size:1.15rem">Evening Azkar</h3>
        <p>Evening duas and protective remembrances with optional reminder scheduling.</p>
      </div>
    </div>
  </div>
</section>

<!-- BENEFICIARY APPLICATION -->
<section class="section" id="beneficiary">
  <div class="section-header reveal">
    <div class="section-label">Apply For Help</div>
    <h2>Beneficiary Applications</h2>
    <p class="section-sub">A secure step-by-step application, verification, and approval process for those in need.</p>
  </div>
  <div class="section" style="max-width:1000px;margin:0 auto">
    <div class="feature-card reveal">
      <h3>Step-by-step process</h3>
      <ol>
        <li>Apply with details & documents</li>
        <li>Identity & income verification</li>
        <li>Admin review & approval</li>
        <li>Distribution & receipt upload</li>
      </ol>
    </div>
  </div>
</section>

<!-- DONOR EXPERIENCE -->
<section class="section-full" id="donor-experience">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Donor</div>
      <h2>Donor Dashboard Preview</h2>
      <p class="section-sub">Donation history, monthly giving, receipts, and impact tracking — all in one place.</p>
    </div>
    <div class="donor-mock reveal" style="max-width:1000px;margin:0 auto;display:flex;gap:1rem">
      <div style="flex:1;background:var(--card-bg);padding:1rem;border-radius:12px;border:1px solid var(--border)">
        <h4>Recent Donations</h4>
        <p>View receipts and impact updates for every donation.</p>
      </div>
      <div style="flex:1;background:var(--card-bg);padding:1rem;border-radius:12px;border:1px solid var(--border)">
        <h4>Monthly Giving</h4>
        <p>Set recurring donations and track monthly impact.</p>
      </div>
    </div>
  </div>
</section>

<!-- SUCCESS STORIES -->
<section class="section" id="stories">
  <div class="section-header reveal">
    <div class="section-label">Stories</div>
    <h2>Beneficiary Stories</h2>
    <p class="section-sub">Real stories of impact with large imagery and modern storytelling layouts.</p>
  </div>
  <div style="max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:1rem">
    <div class="feature-card reveal">
      <div style="height:160px;background:var(--sage);border-radius:8px;margin-bottom:1rem"></div>
      <h4>Rebuilding Lives</h4>
      <p>How community support provided sustainable assistance to a family.</p>
    </div>
    <div class="feature-card reveal">
      <div style="height:160px;background:var(--beige);border-radius:8px;margin-bottom:1rem"></div>
      <h4>Education for Children</h4>
      <p>Scholarship initiatives that transformed learning opportunities.</p>
    </div>
  </div>
</section>

<!-- SECURITY & TRUST -->
<section class="section" id="security">
  <div class="section-header reveal">
    <div class="section-label">Security</div>
    <h2>Security & Compliance</h2>
    <p class="section-sub">Encryption, KYC for beneficiaries, audit logs, and Shariah oversight ensure maximum trust.</p>
  </div>
  <div style="max-width:900px;margin:0 auto;display:flex;gap:1rem">
    <div class="feature-card reveal" style="flex:1">
      <h4>Secure Payments</h4>
      <p>PCI-compliant payment handling and encrypted storage for sensitive data.</p>
    </div>
    <div class="feature-card reveal" style="flex:1">
      <h4>Shariah Governance</h4>
      <p>Independent Shariah board reviews policies, disbursements, and reporting.</p>
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
  <div class="calc-wrapper reveal">
    <div class="calc-steps-bar">
      <div class="calc-step-tab active" onclick="goToStep(1)">
        <span class="step-num">1</span>Gold & Silver
      </div>
      <div class="calc-step-tab" onclick="goToStep(2)">
        <span class="step-num">2</span>Cash & Savings
      </div>
      <div class="calc-step-tab" onclick="goToStep(3)">
        <span class="step-num">3</span>Investments
      </div>
      <div class="calc-step-tab" onclick="goToStep(4)">
        <span class="step-num">4</span>Liabilities
      </div>
      <div class="calc-step-tab" onclick="goToStep(5)">
        <span class="step-num">5</span>Result
      </div>
    </div>
    <div class="calc-body">

      <!-- Step 1 -->
      <div class="calc-step active" id="step-1">
        <h3>🥇 Gold & Silver</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>Gold Weight (grams)</label>
            <input type="number" id="goldWeight" placeholder="e.g. 50" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Gold Value (PKR)</label>
            <input type="number" id="goldValue" placeholder="e.g. 500000" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Silver Weight (grams)</label>
            <input type="number" id="silverWeight" placeholder="e.g. 200" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Silver Value (PKR)</label>
            <input type="number" id="silverValue" placeholder="e.g. 25000" min="0" oninput="calcZakat()">
          </div>
        </div>
        <div class="calc-nav">
          <span class="calc-progress">Step 1 of 4</span>
          <button class="btn-primary" onclick="goToStep(2)">Next →</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="calc-step" id="step-2">
        <h3>💰 Cash & Savings</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>Cash in Hand (PKR)</label>
            <input type="number" id="cashHand" placeholder="e.g. 50000" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Bank Balance (PKR)</label>
            <input type="number" id="bankBalance" placeholder="e.g. 200000" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Foreign Currency (PKR)</label>
            <input type="number" id="foreignCurrency" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Other Savings (PKR)</label>
            <input type="number" id="savings" placeholder="e.g. 100000" min="0" oninput="calcZakat()">
          </div>
        </div>
        <div class="calc-nav">
          <button class="btn-secondary" onclick="goToStep(1)">← Back</button>
          <span class="calc-progress">Step 2 of 4</span>
          <button class="btn-primary" onclick="goToStep(3)">Next →</button>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="calc-step" id="step-3">
        <h3>📈 Investments</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>Stocks Value (PKR)</label>
            <input type="number" id="stocks" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Mutual Funds (PKR)</label>
            <input type="number" id="mutualFunds" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Business Inventory (PKR)</label>
            <input type="number" id="businessInventory" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Other Investments (PKR)</label>
            <input type="number" id="otherInvestments" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
        </div>
        <div class="calc-nav">
          <button class="btn-secondary" onclick="goToStep(2)">← Back</button>
          <span class="calc-progress">Step 3 of 4</span>
          <button class="btn-primary" onclick="goToStep(4)">Next →</button>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="calc-step" id="step-4">
        <h3>📉 Liabilities</h3>
        <div class="form-grid">
          <div class="form-group">
            <label>Loans (PKR)</label>
            <input type="number" id="loans" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group">
            <label>Bills Due (PKR)</label>
            <input type="number" id="billsDue" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
          <div class="form-group" style="grid-column:1/-1">
            <label>Other Debts (PKR)</label>
            <input type="number" id="otherDebts" placeholder="e.g. 0" min="0" oninput="calcZakat()">
          </div>
        </div>
        <div class="calc-nav">
          <button class="btn-secondary" onclick="goToStep(3)">← Back</button>
          <span class="calc-progress">Step 4 of 4</span>
          <button class="btn-primary" onclick="showResult()">Calculate Zakat ✦</button>
        </div>
      </div>

      <!-- Step 5: Result -->
      <div class="calc-step" id="step-5">
        <h3>✦ Your Zakat Summary</h3>
        <div class="nisab-badge" id="nisabBadge">✅ Nisab Reached — Zakat is Obligatory</div>
        <div class="result-summary">
          <div class="result-item">
            <div class="r-label">Total Assets</div>
            <div class="r-value" id="totalAssets">PKR 0</div>
          </div>
          <div class="result-item">
            <div class="r-label">Total Liabilities</div>
            <div class="r-value" id="totalLiabilities">PKR 0</div>
          </div>
          <div class="result-item">
            <div class="r-label">Net Zakatable Wealth</div>
            <div class="r-value" id="netWealth">PKR 0</div>
          </div>
          <div class="result-item highlight">
            <div class="r-label">Zakat Due (2.5%)</div>
            <div class="r-value" id="zakatDue">PKR 0</div>
          </div>
        </div>
        <div class="result-actions">
          <button class="btn-primary" onclick="printResult()">🖨️ Print Report</button>
          <button class="btn-outline" onclick="downloadPDF()">⬇️ Download PDF</button>
          <button class="btn-reset" onclick="resetCalc()">↺ Reset</button>
        </div>
      </div>
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
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem">
    <div class="feature-card reveal reveal-delay-1" style="padding:0;overflow:hidden">
      <div style="height:160px;background:var(--sage);display:flex;align-items:center;justify-content:center;font-size:3rem;position:relative">
        🕌
        <div style="position:absolute;inset:0;background:rgba(69,108,93,0.15);display:flex;align-items:center;justify-content:center">
          <div style="width:52px;height:52px;border-radius:50%;background:white;display:flex;align-items:center;justify-content:center;font-size:1.25rem;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.15)">▶</div>
        </div>
      </div>
      <div style="padding:1.25rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--dark);margin-bottom:0.4rem">Understanding Zakat: A Complete Guide</h3>
        <p style="font-size:0.78rem;color:var(--text-light);margin-bottom:0.75rem">Sheikh Dr. Yasir Qadhi</p>
        <div style="display:flex;justify-content:space-between;align-items:center">
          <span style="font-size:0.75rem;color:var(--text-light)">⏱ 42 min</span>
          <button class="btn-primary" style="padding:8px 16px;font-size:0.78rem">Watch</button>
        </div>
      </div>
    </div>
    <div class="feature-card reveal reveal-delay-2" style="padding:0;overflow:hidden">
      <div style="height:160px;background:var(--beige);display:flex;align-items:center;justify-content:center;font-size:3rem;position:relative">
        📿
        <div style="position:absolute;inset:0;background:rgba(69,108,93,0.12);display:flex;align-items:center;justify-content:center">
          <div style="width:52px;height:52px;border-radius:50%;background:white;display:flex;align-items:center;justify-content:center;font-size:1.25rem;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.15)">▶</div>
        </div>
      </div>
      <div style="padding:1.25rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--dark);margin-bottom:0.4rem">The Power of Daily Dhikr</h3>
        <p style="font-size:0.78rem;color:var(--text-light);margin-bottom:0.75rem">Mufti Menk</p>
        <div style="display:flex;justify-content:space-between;align-items:center">
          <span style="font-size:0.75rem;color:var(--text-light)">⏱ 28 min</span>
          <button class="btn-primary" style="padding:8px 16px;font-size:0.78rem">Watch</button>
        </div>
      </div>
    </div>
    <div class="feature-card reveal reveal-delay-3" style="padding:0;overflow:hidden">
      <div style="height:160px;background:var(--muted);display:flex;align-items:center;justify-content:center;font-size:3rem;position:relative">
        ⭐
        <div style="position:absolute;inset:0;background:rgba(69,108,93,0.12);display:flex;align-items:center;justify-content:center">
          <div style="width:52px;height:52px;border-radius:50%;background:white;display:flex;align-items:center;justify-content:center;font-size:1.25rem;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.15)">▶</div>
        </div>
      </div>
      <div style="padding:1.25rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--dark);margin-bottom:0.4rem">Ramadan: The Month of Blessings</h3>
        <p style="font-size:0.78rem;color:var(--text-light);margin-bottom:0.75rem">Nouman Ali Khan</p>
        <div style="display:flex;justify-content:space-between;align-items:center">
          <span style="font-size:0.75rem;color:var(--text-light)">⏱ 35 min</span>
          <button class="btn-primary" style="padding:8px 16px;font-size:0.78rem">Watch</button>
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
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem">
    <div class="feature-card reveal reveal-delay-1" style="padding:0;overflow:hidden">
      <div style="height:160px;background:var(--sage);display:flex;align-items:center;justify-content:center;font-size:3rem;position:relative">
        🕌
        <div style="position:absolute;inset:0;background:rgba(69,108,93,0.15);display:flex;align-items:center;justify-content:center">
          <div style="width:52px;height:52px;border-radius:50%;background:white;display:flex;align-items:center;justify-content:center;font-size:1.25rem;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.15)">▶</div>
        </div>
      </div>
      <div style="padding:1.25rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--dark);margin-bottom:0.4rem">Understanding Zakat: A Complete Guide</h3>
        <p style="font-size:0.78rem;color:var(--text-light);margin-bottom:0.75rem">Sheikh Dr. Yasir Qadhi</p>
        <div style="display:flex;justify-content:space-between;align-items:center">
          <span style="font-size:0.75rem;color:var(--text-light)">⏱ 42 min</span>
          <button class="btn-primary" style="padding:8px 16px;font-size:0.78rem">Watch</button>
        </div>
      </div>
    </div>
    <div class="feature-card reveal reveal-delay-2" style="padding:0;overflow:hidden">
      <div style="height:160px;background:var(--beige);display:flex;align-items:center;justify-content:center;font-size:3rem;position:relative">
        📿
        <div style="position:absolute;inset:0;background:rgba(69,108,93,0.12);display:flex;align-items:center;justify-content:center">
          <div style="width:52px;height:52px;border-radius:50%;background:white;display:flex;align-items:center;justify-content:center;font-size:1.25rem;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.15)">▶</div>
        </div>
      </div>
      <div style="padding:1.25rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--dark);margin-bottom:0.4rem">The Power of Daily Dhikr</h3>
        <p style="font-size:0.78rem;color:var(--text-light);margin-bottom:0.75rem">Mufti Menk</p>
        <div style="display:flex;justify-content:space-between;align-items:center">
          <span style="font-size:0.75rem;color:var(--text-light)">⏱ 28 min</span>
          <button class="btn-primary" style="padding:8px 16px;font-size:0.78rem">Watch</button>
        </div>
      </div>
    </div>
    <div class="feature-card reveal reveal-delay-3" style="padding:0;overflow:hidden">
      <div style="height:160px;background:var(--muted);display:flex;align-items:center;justify-content:center;font-size:3rem;position:relative">
        ⭐
        <div style="position:absolute;inset:0;background:rgba(69,108,93,0.12);display:flex;align-items:center;justify-content:center">
          <div style="width:52px;height:52px;border-radius:50%;background:white;display:flex;align-items:center;justify-content:center;font-size:1.25rem;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.15)">▶</div>
        </div>
      </div>
      <div style="padding:1.25rem">
        <h3 style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--dark);margin-bottom:0.4rem">Ramadan: The Month of Blessings</h3>
        <p style="font-size:0.78rem;color:var(--text-light);margin-bottom:0.75rem">Nouman Ali Khan</p>
        <div style="display:flex;justify-content:space-between;align-items:center">
          <span style="font-size:0.75rem;color:var(--text-light)">⏱ 35 min</span>
          <button class="btn-primary" style="padding:8px 16px;font-size:0.78rem">Watch</button>
        </div>
      </div>
    </div>
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



@endsection

