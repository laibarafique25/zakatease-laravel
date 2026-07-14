@extends('layouts.app')
@section('content')

<div class="page-header" style="padding-top:120px; padding-bottom:60px; color:var(--dark); text-align:center;">
    <div class="container">
        <h1 style="font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem;">Success Stories</h1>
        <p style="font-size:1.1rem; opacity:0.9; max-width:600px; margin:0 auto;">Read how your Zakat and Sadaqah are changing lives across Pakistan.</p>
    </div>
</div>

<section class="section" style="padding-top:4rem; padding-bottom:6rem; background:var(--bg);">
    <div class="container">
        <!-- Filters -->
        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:20px; margin-bottom:40px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
            <form action="{{ route('success.stories') }}" method="GET" style="display:flex; gap:15px; flex-wrap:wrap; align-items:flex-end;">
                <div style="flex:1; min-width:200px;">
                    <label style="display:block; font-size:0.85rem; color:var(--text-light); margin-bottom:8px; font-weight:600;">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or title..." style="width:100%; padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text);">
                </div>
                <div style="flex:1; min-width:200px;">
                    <label style="display:block; font-size:0.85rem; color:var(--text-light); margin-bottom:8px; font-weight:600;">City</label>
                    <select name="city" style="width:100%; padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text);">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="flex:1; min-width:200px;">
                    <label style="display:block; font-size:0.85rem; color:var(--text-light); margin-bottom:8px; font-weight:600;">Beneficiary Type</label>
                    <select name="user_type" style="width:100%; padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text);">
                        <option value="">All Types</option>
                        @foreach(['widow', 'orphan', 'student', 'small_business_owner', 'patient', 'daily_wage_worker', 'flood_victim', 'disabled'] as $type)
                            <option value="{{ $type }}" {{ request('user_type') == $type ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $type)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn-primary" style="padding:10px 24px;">Filter Results</button>
                    @if(request()->hasAny(['search', 'city', 'user_type']))
                        <a href="{{ route('success.stories') }}" class="btn-secondary" style="padding:10px 16px; margin-left:8px;">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Grid -->
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:30px;">
            @forelse($stories as $story)
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:24px; display:flex; flex-direction:column; gap:16px; transition:transform 0.3s; box-shadow:0 10px 30px rgba(0,0,0,0.05)" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='none'">
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
                    {{ Str::limit($story->story, 150) }}
                </p>
                
                <div style="background:var(--bg); padding:16px; border-radius:8px; display:flex; align-items:center; justify-content:space-between; margin-top:8px; border:1px solid var(--border);">
                    <div style="display:flex; gap:12px; align-items:center">
                        <div style="width:40px; height:40px; border-radius:50%; background:var(--emerald); color:white; display:flex; align-items:center; justify-content:center; font-weight:700">
                            {{ strtoupper(substr($story->full_name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight:600; color:var(--text); font-size:0.9rem">{{ $story->full_name }}</div>
                            <div style="font-size:0.8rem; color:var(--text-light)">{{ $story->city }} &bull; {{ $story->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
                <div style="text-align:right; border-top:1px dashed var(--border); padding-top:12px; display:flex; justify-content:space-between; align-items:center;">
                    <div style="color:#f59e0b; display:flex; gap:2px">
                        @for($i=1; $i<=5; $i++)
                            <svg width="14" height="14" fill="{{ $i <= $story->rating ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                    <div>
                        <span style="font-size:0.75rem; color:var(--text-light); margin-right:6px;">Received</span>
                        <span style="font-weight:700; color:var(--emerald); font-size:1rem;">PKR {{ number_format($story->amount_received) }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1; text-align:center; padding:60px 20px; background:var(--bg-card); border-radius:12px; border:1px solid var(--border);">
                <svg width="48" height="48" fill="none" stroke="var(--text-light)" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:16px; opacity:0.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 style="color:var(--text); margin-bottom:8px;">No stories found</h3>
                <p style="color:var(--text-light);">Try adjusting your search or filters to find what you're looking for.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div style="margin-top:40px; display:flex; justify-content:center;">
            {{ $stories->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>

@endsection
