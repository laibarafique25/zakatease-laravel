@extends('layouts.app')
@section('content')

<div class="page-header" style="padding-top:120px; padding-bottom:60px; color:var(--dark); text-align:center;">
    <div class="container">
        <h1 style="font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem;">Donor Reviews</h1>
        <p style="font-size:1.1rem; opacity:0.9; max-width:600px; margin:0 auto;">Hear from those who have trusted ZARIYAH with their Zakat and Sadaqah.</p>
    </div>
</div>

<section class="section" style="padding-top:4rem; padding-bottom:6rem; background:var(--bg);">
    <div class="container">
        <!-- Filters -->
        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:20px; margin-bottom:40px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
            <form action="{{ route('donor.reviews') }}" method="GET" style="display:flex; gap:15px; flex-wrap:wrap; align-items:flex-end;">
                <div style="flex:1; min-width:200px;">
                    <label style="display:block; font-size:0.85rem; color:var(--text-light); margin-bottom:8px; font-weight:600;">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or review text..." style="width:100%; padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text);">
                </div>
                <div style="flex:1; min-width:200px;">
                    <label style="display:block; font-size:0.85rem; color:var(--text-light); margin-bottom:8px; font-weight:600;">Rating</label>
                    <select name="rating" style="width:100%; padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text);">
                        <option value="">All Ratings</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn-primary" style="padding:10px 24px;">Filter Results</button>
                    @if(request()->hasAny(['search', 'rating']))
                        <a href="{{ route('donor.reviews') }}" class="btn-secondary" style="padding:10px 16px; margin-left:8px;">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Grid -->
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:30px;">
            @forelse($reviews as $review)
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:24px; display:flex; flex-direction:column; gap:16px; transition:transform 0.3s; box-shadow:0 10px 30px rgba(0,0,0,0.05)" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='none'">
                <div style="display:flex; justify-content:space-between; align-items:flex-start">
                    <div style="display:flex; gap:12px; align-items:center">
                        <div style="width:48px; height:48px; border-radius:50%; background:var(--emerald); color:white; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.2rem">
                            {{ strtoupper(substr($review->donor_name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 style="margin:0; font-size:1.1rem; color:var(--text)">{{ $review->donor_name }}</h4>
                            <div style="font-size:0.85rem; color:var(--text-light)">{{ $review->city }} &bull; {{ $review->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @if($review->is_verified)
                    <div style="color:var(--emerald); display:flex; align-items:center; gap:4px; font-size:0.8rem; font-weight:600; background:rgba(16,185,129,0.1); padding:4px 8px; border-radius:20px;">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg> Verified
                    </div>
                    @endif
                </div>
                
                <div style="color:var(--text-light); font-size:0.95rem; font-style:italic; line-height:1.6; flex-grow:1; padding:12px 0;">
                    "{{ $review->review }}"
                </div>
                
                <div style="border-top:1px dashed var(--border); padding-top:16px; display:flex; justify-content:space-between; align-items:center">
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
            @empty
            <div style="grid-column:1/-1; text-align:center; padding:60px 20px; background:var(--bg-card); border-radius:12px; border:1px solid var(--border);">
                <svg width="48" height="48" fill="none" stroke="var(--text-light)" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:16px; opacity:0.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 style="color:var(--text); margin-bottom:8px;">No reviews found</h3>
                <p style="color:var(--text-light);">Try adjusting your search or filters to find what you're looking for.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div style="margin-top:40px; display:flex; justify-content:center;">
            {{ $reviews->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>

@endsection
