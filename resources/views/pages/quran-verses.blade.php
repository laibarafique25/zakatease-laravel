@extends('layouts.app')
@section('content')

<!-- PAGE HEADER -->
<div class="page-header" style="padding-top:120px; padding-bottom:60px; color:var(--dark); text-align:center;">
    <div class="container">
        <h1 style="font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem;">Quranic Verses</h1>
        <p style="font-size:1.1rem; opacity:0.9; max-width:600px; margin:0 auto;">Read and reflect on verses regarding charity and purity.</p>
    </div>
</div>

<section class="section" style="padding-top:4rem; padding-bottom:6rem; background:var(--bg); text-align:center; min-height:40vh;">
    <div class="container">
        <div style="display:inline-block; padding:40px; border-radius:12px; background:var(--bg-card); border:1px dashed var(--border); max-width:500px; margin:0 auto;">
            <svg width="48" height="48" fill="none" stroke="var(--text-light)" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            <h2 style="font-size:1.5rem; color:var(--text); margin-bottom:10px;">Coming Soon</h2>
            <p style="color:var(--text-light);">We are currently gathering translations and tafseer for this section. Please check back later.</p>
            <br>
            <a href="{{ route('islamic.hub') }}" class="btn-primary">Back to Hub</a>
        </div>
    </div>
</section>

@endsection
