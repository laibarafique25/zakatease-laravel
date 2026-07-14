<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MarketRate;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Artisan;

class MarketRateController extends Controller
{
    public function index()
    {
        $gold = MarketRate::where('type', 'gold')->first();
        $silver = MarketRate::where('type', 'silver')->first();
        $exchangeRates = ExchangeRate::all();
        
        return view('admin.market_rates.index', compact('gold', 'silver', 'exchangeRates'));
    }

    public function sync()
    {
        Artisan::call('market:sync');
        return redirect()->back()->with('success', 'Market rates synced successfully!');
    }
}
