<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuccessStory;
use App\Models\DonorReview;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Organization;
use App\Models\User;

class PageController extends Controller
{
    public function home() { 
        $successStories = SuccessStory::where('is_verified', true)->orderByDesc('is_featured')->latest()->take(6)->get();
        $donorReviews = DonorReview::where('is_verified', true)->orderByDesc('is_featured')->latest()->take(6)->get();
        $campaigns = Campaign::where('status', 'active')->orderByDesc('is_featured')->latest()->take(3)->get();
        $goldRate = \App\Models\MarketRate::where('type', 'gold')->first();
        $silverRate = \App\Models\MarketRate::where('type', 'silver')->first();
        $exchangeRates = \App\Models\ExchangeRate::all();
        return view('pages.home', compact('successStories', 'donorReviews', 'campaigns', 'goldRate', 'silverRate', 'exchangeRates')); 
    }

    public function campaigns(Request $request) { 
        $query = Campaign::where('status', 'active');
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }
        $campaigns = $query->orderByDesc('is_featured')->latest()->paginate(9);
        return view('pages.campaigns', compact('campaigns')); 
    }

    public function transparency() { 
        $totalDonations = Donation::where('status', 'completed')->sum('amount');
        $totalZakat = Donation::where('status', 'completed')->where('type', 'zakat')->sum('amount');
        $totalSadaqah = Donation::where('status', 'completed')->where('type', 'sadaqa')->sum('amount');
        $totalBeneficiaries = User::where('role', 'receiver')->count();
        $totalCampaigns = Campaign::where('status', 'active')->count();
        $recentDonations = Donation::with('user')->where('status', 'completed')->latest()->take(10)->get();
        $verifiedOrgs = Organization::where('is_verified', true)->get();
        return view('pages.transparency', compact(
            'totalDonations', 'totalZakat', 'totalSadaqah', 'totalBeneficiaries', 
            'totalCampaigns', 'recentDonations', 'verifiedOrgs'
        )); 
    }

    public function successStories(Request $request) {
        $query = SuccessStory::where('is_verified', true);
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('full_name', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->has('city') && $request->city != '') {
            $query->where('city', $request->city);
        }
        if ($request->has('user_type') && $request->user_type != '') {
            $query->where('user_type', $request->user_type);
        }
        $stories = $query->orderByDesc('is_featured')->latest()->paginate(12);
        $cities = SuccessStory::where('is_verified', true)->distinct()->pluck('city')->filter();
        return view('pages.success-stories', compact('stories', 'cities'));
    }

    public function donorReviews(Request $request) {
        $query = DonorReview::where('is_verified', true);
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('donor_name', 'like', '%' . $request->search . '%')
                  ->orWhere('review', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->has('rating') && $request->rating != '') {
            $query->where('rating', $request->rating);
        }
        $reviews = $query->orderByDesc('is_featured')->latest()->paginate(12);
        return view('pages.donor-reviews', compact('reviews'));
    }
    public function calculator() { 
        $goldRate = \App\Models\MarketRate::where('type', 'gold')->first();
        $silverRate = \App\Models\MarketRate::where('type', 'silver')->first();
        $exchangeRates = \App\Models\ExchangeRate::all();
        return view('pages.calculator', compact('goldRate', 'silverRate', 'exchangeRates')); 
    }
    public function apply() { return view('pages.apply'); }
    public function faq() { return view('pages.faq'); }
    public function contact() { return view('pages.contact'); }
    public function login() { return view('pages.login'); }
    public function signup() { return view('pages.signup'); }
    public function hadith() { return view('pages.hadith'); }
    public function prayer() { return view('pages.prayer'); }
    public function lectures() { return view('pages.lectures'); }
    public function tasbeeh() { return view('pages.tasbeeh'); }
    public function islamicHub() { return view('pages.islamic-hub'); }
    public function knowledgeCenter() { return view('pages.knowledge-center'); }
    public function quranVerses() { return view('pages.quran-verses'); }
}
