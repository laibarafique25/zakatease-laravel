@extends('layouts.app')
@section('content')

<!-- PAGE HEADER -->
<div class="page-header" style="padding-top:120px; padding-bottom:60px; color:var(--dark); text-align:center;">
    <div class="container">
        <h1 style="font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem;">Knowledge Center</h1>
        <p style="font-size:1.1rem; opacity:0.9; max-width:600px; margin:0 auto;">Deepen your understanding of Zakat and Islamic Finance.</p>
    </div>
</div>

<section class="section" style="padding-top:4rem; padding-bottom:6rem; background:var(--bg); text-align:center; min-height:40vh;">
    <div class="container">
        <div style="display:inline-block; padding:40px; border-radius:12px; background:var(--bg-card); border:1px dashed var(--border); max-width:500px; margin:0 auto;">
            <svg width="48" height="48" fill="none" stroke="var(--text-light)" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            <h2 style="font-size:1.5rem; color:var(--text); margin-bottom:10px;">Coming Soon</h2>
            <p style="color:var(--text-light);">We are currently curating authentic Islamic content for this section. Please check back later.</p>
            <br>
            <a href="{{ route('islamic.hub') }}" class="btn-primary">Back to Hub</a>
        </div>
    </div>
</section>

@endsection
