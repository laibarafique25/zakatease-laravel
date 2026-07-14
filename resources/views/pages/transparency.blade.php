@extends('layouts.app')
@section('content')

<div class="page-header" style="padding-top:120px; padding-bottom:60px; color:var(--dark); text-align:center;">
    <div class="container">
        <h1 style="font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem;">Transparency Dashboard</h1>
        <p style="font-size:1.1rem; opacity:0.9; max-width:600px; margin:0 auto;">Track donations, spending, and impact with complete clarity. No hidden fees, 100% transparency.</p>
    </div>
</div>

<section class="section" style="padding-top:4rem; padding-bottom:6rem; background:var(--bg);">
    <div class="container">
        
        <!-- Key Metrics Cards -->
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:24px; margin-bottom:60px;">
            <div style="background:var(--bg-card); padding:30px; border-radius:16px; border:1px solid var(--border); box-shadow:0 10px 30px rgba(0,0,0,0.05); text-align:center;">
                <div style="font-size:0.9rem; color:var(--text-light); text-transform:uppercase; font-weight:600; letter-spacing:1px; margin-bottom:8px;">Total Donations</div>
                <div style="font-family:'Playfair Display', serif; font-size:2.5rem; color:var(--emerald); font-weight:700;">PKR {{ number_format($totalDonations) }}</div>
            </div>
            
            <div style="background:var(--bg-card); padding:30px; border-radius:16px; border:1px solid var(--border); box-shadow:0 10px 30px rgba(0,0,0,0.05); text-align:center;">
                <div style="font-size:0.9rem; color:var(--text-light); text-transform:uppercase; font-weight:600; letter-spacing:1px; margin-bottom:8px;">Zakat Distributed</div>
                <div style="font-family:'Playfair Display', serif; font-size:2.5rem; color:var(--emerald); font-weight:700;">PKR {{ number_format($totalZakat) }}</div>
            </div>
            
            <div style="background:var(--bg-card); padding:30px; border-radius:16px; border:1px solid var(--border); box-shadow:0 10px 30px rgba(0,0,0,0.05); text-align:center;">
                <div style="font-size:0.9rem; color:var(--text-light); text-transform:uppercase; font-weight:600; letter-spacing:1px; margin-bottom:8px;">Beneficiaries</div>
                <div style="font-family:'Playfair Display', serif; font-size:2.5rem; color:var(--emerald); font-weight:700;">{{ number_format($totalBeneficiaries) }}</div>
            </div>
            
            <div style="background:var(--bg-card); padding:30px; border-radius:16px; border:1px solid var(--border); box-shadow:0 10px 30px rgba(0,0,0,0.05); text-align:center;">
                <div style="font-size:0.9rem; color:var(--text-light); text-transform:uppercase; font-weight:600; letter-spacing:1px; margin-bottom:8px;">Active Campaigns</div>
                <div style="font-family:'Playfair Display', serif; font-size:2.5rem; color:var(--emerald); font-weight:700;">{{ number_format($totalCampaigns) }}</div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:minmax(0, 2fr) minmax(0, 1fr); gap:40px; align-items:start;">
            
            <!-- Left Column -->
            <div>
                <!-- Recent Donations -->
                <div style="background:var(--bg-card); padding:30px; border-radius:16px; border:1px solid var(--border); margin-bottom:40px;">
                    <h3 style="font-size:1.4rem; color:var(--text); margin-bottom:20px;">Recent Contributions</h3>
                    <div style="display:flex; flex-direction:column; gap:16px;">
                        @foreach($recentDonations as $donation)
                        <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:16px; border-bottom:1px solid var(--border);">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:40px; height:40px; border-radius:50%; background:rgba(16,185,129,0.1); color:var(--emerald); display:flex; align-items:center; justify-content:center; font-weight:700;">
                                    {{ $donation->is_anonymous ? 'A' : strtoupper(substr($donation->user->name ?? 'D', 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600; color:var(--text);">{{ $donation->is_anonymous ? 'Anonymous Donor' : ($donation->user->name ?? 'Guest') }}</div>
                                    <div style="font-size:0.8rem; color:var(--text-light);">{{ $donation->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-weight:700; color:var(--emerald);">PKR {{ number_format($donation->amount) }}</div>
                                <div style="font-size:0.75rem; color:var(--text-light); text-transform:uppercase;">{{ $donation->type }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Verified Orgs -->
                <div style="background:var(--bg-card); padding:30px; border-radius:16px; border:1px solid var(--border);">
                    <h3 style="font-size:1.4rem; color:var(--text); margin-bottom:20px;">Verified Partners</h3>
                    <p style="color:var(--text-light); font-size:0.9rem; margin-bottom:24px; line-height:1.6;">
                        All organizations listed below undergo strict vetting and continuous auditing to ensure your Zakat reaches those who deserve it.
                    </p>
                    <div style="display:flex; flex-direction:column; gap:16px;">
                        @foreach($verifiedOrgs as $org)
                        <div style="display:flex; gap:12px; align-items:center; padding:12px; background:var(--bg); border-radius:8px; border:1px solid var(--border);">
                            <div style="width:48px; height:48px; border-radius:8px; background:white; overflow:hidden; border:1px solid var(--border);">
                                @if($org->logo)
                                    <img src="{{ Storage::url($org->logo) }}" style="width:100%; height:100%; object-fit:contain;">
                                @else
                                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:var(--emerald); font-weight:bold;">{{ substr($org->name, 0, 1) }}</div>
                                @endif
                            </div>
                            <div>
                                <div style="font-weight:600; color:var(--text); font-size:0.95rem;">{{ $org->name }}</div>
                                <div style="display:flex; align-items:center; gap:4px; font-size:0.75rem; color:var(--text-light);">
                                    <svg width="12" height="12" fill="var(--emerald)" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                    Audited & Verified
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
