@extends('layouts.app')
@section('content')


<section class="section" id="lectures-page">
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
</section>


@endsection

