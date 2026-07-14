@extends('layouts.app')
@section('content')

<!-- PAGE HEADER -->
<div class="page-header" style="padding-top:120px; padding-bottom:60px; color:var(--dark); text-align:center;">
    <div class="container">
        <h1 style="font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem;">Islamic Hub</h1>
        <p style="font-size:1.1rem; opacity:0.9; max-width:600px; margin:0 auto;">Your complete portal for daily spiritual growth, authentic knowledge, and continuous remembrance of Allah.</p>
    </div>
</div>

<!-- HUB GRID -->
<section class="section" style="padding-top:4rem; padding-bottom:6rem; background:var(--bg);">
    <div class="container">
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:30px;">
            
            <!-- Card 1: Prayer Times -->
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:30px; transition:transform 0.3s, box-shadow 0.3s; display:flex; flex-direction:column;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(16,185,129,0.1)'" onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
                <div style="width:60px; height:60px; border-radius:12px; background:rgba(16,185,129,0.1); color:var(--emerald); display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 style="font-size:1.4rem; color:var(--text); margin-bottom:10px;">Prayer Times</h3>
                <p style="color:var(--text-light); font-size:0.95rem; line-height:1.6; margin-bottom:24px; flex-grow:1;">Accurate daily prayer times based on your location, including countdowns to the next Salah.</p>
                <a href="{{ route('prayer') }}" class="btn-primary" style="text-align:center; display:block;">Explore</a>
            </div>

            <!-- Card 2: Daily Hadith -->
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:30px; transition:transform 0.3s, box-shadow 0.3s; display:flex; flex-direction:column;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(16,185,129,0.1)'" onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
                <div style="width:60px; height:60px; border-radius:12px; background:rgba(16,185,129,0.1); color:var(--emerald); display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 style="font-size:1.4rem; color:var(--text); margin-bottom:10px;">Daily Hadith</h3>
                <p style="color:var(--text-light); font-size:0.95rem; line-height:1.6; margin-bottom:24px; flex-grow:1;">Authentic sayings of Prophet Muhammad (PBUH) updated daily to guide your everyday life.</p>
                <a href="{{ route('hadith') }}" class="btn-primary" style="text-align:center; display:block;">Explore</a>
            </div>

            <!-- Card 3: Daily Azkar -->
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:30px; transition:transform 0.3s, box-shadow 0.3s; display:flex; flex-direction:column;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(16,185,129,0.1)'" onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
                <div style="width:60px; height:60px; border-radius:12px; background:rgba(16,185,129,0.1); color:var(--emerald); display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 style="font-size:1.4rem; color:var(--text); margin-bottom:10px;">Daily Azkar</h3>
                <p style="color:var(--text-light); font-size:0.95rem; line-height:1.6; margin-bottom:24px; flex-grow:1;">Morning, evening, and after-prayer supplications for spiritual protection and peace.</p>
                <a href="{{ route('azkar') }}" class="btn-primary" style="text-align:center; display:block;">Explore</a>
            </div>

            <!-- Card 4: Digital Tasbeeh -->
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:30px; transition:transform 0.3s, box-shadow 0.3s; display:flex; flex-direction:column;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(16,185,129,0.1)'" onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
                <div style="width:60px; height:60px; border-radius:12px; background:rgba(16,185,129,0.1); color:var(--emerald); display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 style="font-size:1.4rem; color:var(--text); margin-bottom:10px;">Digital Tasbeeh</h3>
                <p style="color:var(--text-light); font-size:0.95rem; line-height:1.6; margin-bottom:24px; flex-grow:1;">A sleek, interactive tool to keep track of your daily Dhikr without losing count.</p>
                <a href="{{ route('tasbeeh') }}" class="btn-primary" style="text-align:center; display:block;">Explore</a>
            </div>

            <!-- Card 5: Knowledge Center -->
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:30px; transition:transform 0.3s, box-shadow 0.3s; display:flex; flex-direction:column;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(16,185,129,0.1)'" onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
                <div style="width:60px; height:60px; border-radius:12px; background:rgba(16,185,129,0.1); color:var(--emerald); display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <h3 style="font-size:1.4rem; color:var(--text); margin-bottom:10px;">Knowledge Center</h3>
                <p style="color:var(--text-light); font-size:0.95rem; line-height:1.6; margin-bottom:24px; flex-grow:1;">Articles, fatwas, and detailed explanations of Islamic rulings related to charity and finance.</p>
                <a href="{{ route('knowledge.center') }}" class="btn-primary" style="text-align:center; display:block;">Explore</a>
            </div>

            <!-- Card 6: Quranic Verses -->
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:30px; transition:transform 0.3s, box-shadow 0.3s; display:flex; flex-direction:column;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(16,185,129,0.1)'" onmouseout="this.style.transform='none'; this.style.boxShadow='none'">
                <div style="width:60px; height:60px; border-radius:12px; background:rgba(16,185,129,0.1); color:var(--emerald); display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                    <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                </div>
                <h3 style="font-size:1.4rem; color:var(--text); margin-bottom:10px;">Quranic Verses</h3>
                <p style="color:var(--text-light); font-size:0.95rem; line-height:1.6; margin-bottom:24px; flex-grow:1;">Curated verses from the Holy Quran emphasizing Zakat, Sadaqah, and purity of wealth.</p>
                <a href="{{ route('quran.verses') }}" class="btn-primary" style="text-align:center; display:block;">Explore</a>
            </div>

        </div>
    </div>
</section>

@endsection
