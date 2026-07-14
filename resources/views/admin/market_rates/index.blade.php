@extends('layouts.admin')

@section('title', 'Market Rates')

@section('content')
<div class="admin-card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h2 class="card-title">Live Market Rates</h2>
        <form action="{{ route('admin.market_rates.sync') }}" method="POST">
            @csrf
            <button class="btn-primary">🔄 Refresh Rates Now</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin: 1.5rem; padding: 1rem; background: rgba(16,185,129,0.1); color: var(--emerald); border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="padding: 1.5rem;">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            
            <!-- Gold Card -->
            <div style="border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; background: var(--bg-card);">
                <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <h3 style="margin:0;">🟡 Gold</h3>
                    <span style="font-size: 0.8rem; background: var(--emerald); color: white; padding: 2px 8px; border-radius: 12px;">Live</span>
                </div>
                @if($gold)
                    <p style="font-size: 1.5rem; font-weight: bold; color: var(--dark); margin: 0;">{{ number_format($gold->price) }} PKR</p>
                    <p style="color: var(--text-light); font-size: 0.9rem;">per {{ ucfirst($gold->unit) }}</p>
                    <hr style="border-color: var(--border); margin: 1rem 0;">
                    <p style="font-size: 0.8rem; color: var(--text-light); margin:0;">Last updated: {{ \Carbon\Carbon::parse($gold->updated_at)->diffForHumans() }}</p>
                    <p style="font-size: 0.8rem; color: var(--text-light); margin:0;">Source: {{ $gold->source ?? 'API' }}</p>
                @else
                    <p>No gold rate synced yet.</p>
                @endif
            </div>

            <!-- Silver Card -->
            <div style="border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; background: var(--bg-card);">
                <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <h3 style="margin:0;">⚪ Silver</h3>
                    <span style="font-size: 0.8rem; background: var(--emerald); color: white; padding: 2px 8px; border-radius: 12px;">Live</span>
                </div>
                @if($silver)
                    <p style="font-size: 1.5rem; font-weight: bold; color: var(--dark); margin: 0;">{{ number_format($silver->price) }} PKR</p>
                    <p style="color: var(--text-light); font-size: 0.9rem;">per {{ ucfirst($silver->unit) }}</p>
                    <hr style="border-color: var(--border); margin: 1rem 0;">
                    <p style="font-size: 0.8rem; color: var(--text-light); margin:0;">Last updated: {{ \Carbon\Carbon::parse($silver->updated_at)->diffForHumans() }}</p>
                    <p style="font-size: 0.8rem; color: var(--text-light); margin:0;">Source: {{ $silver->source ?? 'API' }}</p>
                @else
                    <p>No silver rate synced yet.</p>
                @endif
            </div>

            <!-- Settings Card -->
            <div style="border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; background: var(--bg-card);">
                <h3 style="margin-top:0; margin-bottom:1rem;">⚙️ Settings</h3>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span style="color: var(--dark); font-weight: 500;">Background Auto Sync</span>
                    <label class="switch" style="position: relative; display: inline-block; width: 40px; height: 20px;">
                        <input type="checkbox" checked disabled style="opacity: 0; width: 0; height: 0;">
                        <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: var(--emerald); border-radius: 20px;"></span>
                        <span style="position: absolute; content: ''; height: 16px; width: 16px; left: 2px; bottom: 2px; background-color: white; border-radius: 50%; transform: translateX(20px);"></span>
                    </label>
                </div>
                <p style="font-size: 0.8rem; color: var(--text-light);">Auto sync runs every 6 hours via Laravel Scheduler.</p>
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem;">
                    <span style="color: var(--dark); font-weight: 500;">API Status</span>
                    <span style="color: var(--emerald); font-size: 0.9rem; font-weight: bold;">● Active</span>
                </div>
            </div>
            
        </div>

        <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: var(--dark);">Currency Exchange Rates</h3>
        <table class="table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid var(--border); text-align: left;">
                    <th style="padding: 10px;">Currency</th>
                    <th style="padding: 10px;">Rate to PKR</th>
                    <th style="padding: 10px;">Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exchangeRates as $rate)
                <tr style="border-bottom: 1px solid var(--border);">
                    <td style="padding: 10px; font-weight: bold;">{{ $rate->currency_code }}</td>
                    <td style="padding: 10px; color: var(--emerald);">{{ number_format($rate->rate_to_pkr, 2) }} PKR</td>
                    <td style="padding: 10px; color: var(--text-light);">{{ $rate->updated_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
