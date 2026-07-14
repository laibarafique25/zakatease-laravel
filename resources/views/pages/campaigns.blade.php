@extends('layouts.app')
@section('content')

<div class="page-header" style="padding-top:120px; padding-bottom:60px; color:var(--dark); text-align:center;">
    <div class="container">
        <h1 style="font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem;">Active Campaigns</h1>
        <p style="font-size:1.1rem; opacity:0.9; max-width:600px; margin:0 auto;">Discover ongoing initiatives where your support makes the largest impact.</p>
    </div>
</div>

<section class="section" style="padding-top:4rem; padding-bottom:6rem; background:var(--bg);">
    <div class="container">
        <!-- Filters -->
        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:20px; margin-bottom:40px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
            <form action="{{ route('campaigns') }}" method="GET" style="display:flex; gap:15px; flex-wrap:wrap; align-items:flex-end;">
                <div style="flex:1; min-width:200px;">
                    <label style="display:block; font-size:0.85rem; color:var(--text-light); margin-bottom:8px; font-weight:600;">Search Campaigns</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..." style="width:100%; padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text);">
                </div>
                <div style="flex:1; min-width:200px;">
                    <label style="display:block; font-size:0.85rem; color:var(--text-light); margin-bottom:8px; font-weight:600;">Category</label>
                    <select name="type" style="width:100%; padding:10px 14px; border:1px solid var(--border); border-radius:8px; background:var(--bg); color:var(--text);">
                        <option value="">All Categories</option>
                        <option value="zakat" {{ request('type') == 'zakat' ? 'selected' : '' }}>Zakat Eligible</option>
                        <option value="sadaqah" {{ request('type') == 'sadaqah' ? 'selected' : '' }}>Sadaqah</option>
                        <option value="emergency" {{ request('type') == 'emergency' ? 'selected' : '' }}>Emergency Relief</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn-primary" style="padding:10px 24px;">Filter</button>
                    @if(request()->hasAny(['search', 'type']))
                        <a href="{{ route('campaigns') }}" class="btn-secondary" style="padding:10px 16px; margin-left:8px;">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Grid -->
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(350px, 1fr)); gap:30px;">
            @forelse($campaigns as $campaign)
            @php
                $progress = $campaign->goal_amount > 0 ? min(100, round(($campaign->raised_amount / $campaign->goal_amount) * 100)) : 0;
                $daysRemaining = $campaign->end_date ? \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($campaign->end_date), false) : null;
            @endphp
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:16px; overflow:hidden; display:flex; flex-direction:column; transition:transform 0.3s; box-shadow:0 10px 30px rgba(0,0,0,0.05)" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='none'">
                
                <!-- Image -->
                <div style="height:200px; background:#e5e7eb; position:relative;">
                    @if($campaign->image)
                        <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:var(--text-light); font-size:3rem; background:var(--sage); opacity:0.3">
                            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    
                    @if($campaign->is_urgent)
                        <div style="position:absolute; top:12px; right:12px; background:#ef4444; color:white; font-size:0.75rem; font-weight:700; padding:4px 10px; border-radius:20px; text-transform:uppercase;">
                            Urgent
                        </div>
                    @endif
                    <div style="position:absolute; top:12px; left:12px; background:rgba(255,255,255,0.9); color:var(--emerald); font-size:0.75rem; font-weight:700; padding:4px 10px; border-radius:20px; text-transform:uppercase;">
                        {{ $campaign->type }}
                    </div>
                </div>

                <!-- Content -->
                <div style="padding:24px; display:flex; flex-direction:column; flex-grow:1;">
                    <h3 style="margin:0 0 10px 0; font-size:1.25rem; color:var(--text); line-height:1.4">{{ $campaign->title }}</h3>
                    <p style="color:var(--text-light); font-size:0.9rem; line-height:1.6; flex-grow:1; margin:0 0 20px 0;">
                        {{ Str::limit($campaign->description, 100) }}
                    </p>

                    <!-- Progress -->
                    <div style="margin-bottom:20px;">
                        <div style="display:flex; justify-content:space-between; margin-bottom:8px; font-size:0.85rem;">
                            <span style="color:var(--text-light);">Raised: <strong style="color:var(--emerald)">PKR {{ number_format($campaign->raised_amount) }}</strong></span>
                            <span style="color:var(--text-light); font-weight:600">{{ $progress }}%</span>
                        </div>
                        <div style="width:100%; height:8px; background:var(--bg); border-radius:4px; overflow:hidden;">
                            <div style="height:100%; background:var(--emerald); width:{{ $progress }}%; border-radius:4px;"></div>
                        </div>
                        <div style="display:flex; justify-content:space-between; margin-top:8px; font-size:0.8rem; color:var(--text-light);">
                            <span>Goal: PKR {{ number_format($campaign->goal_amount) }}</span>
                            @if($daysRemaining !== null)
                                @if($daysRemaining > 0)
                                    <span>{{ $daysRemaining }} days left</span>
                                @elseif($daysRemaining == 0)
                                    <span style="color:#f59e0b; font-weight:600">Ends Today!</span>
                                @else
                                    <span style="color:#ef4444;">Closed</span>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                        <a href="#" class="btn-primary" style="text-align:center; padding:10px;">Donate</a>
                        <button class="btn-secondary" style="text-align:center; padding:10px; justify-content:center;">Share</button>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1; text-align:center; padding:60px 20px; background:var(--bg-card); border-radius:12px; border:1px solid var(--border);">
                <svg width="48" height="48" fill="none" stroke="var(--text-light)" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom:16px; opacity:0.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <h3 style="color:var(--text); margin-bottom:8px;">No campaigns found</h3>
                <p style="color:var(--text-light);">Try adjusting your search or filters to find what you're looking for.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div style="margin-top:40px; display:flex; justify-content:center;">
            {{ $campaigns->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>

@endsection
