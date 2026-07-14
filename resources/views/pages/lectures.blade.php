@extends('layouts.app')
@section('content')


<section class="section" id="lectures-page">
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
</section>


@endsection
