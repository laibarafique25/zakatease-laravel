<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserPanelController;
use App\Http\Controllers\OrganizationPanelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\PrayerManagementController;
use App\Http\Controllers\Admin\HadithController;
use App\Http\Controllers\Admin\AzkarController;
use App\Http\Controllers\Admin\QuranController;
use App\Http\Controllers\Admin\ZakatContentController;
use App\Http\Controllers\Admin\AiKnowledgeController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ActivityLogController;

// PUBLIC WEBSITE ROUTES
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/calculator', [PageController::class, 'calculator'])->name('calculator');
Route::get('/zakat', function() {
    return redirect()->route('calculator');
});
Route::get('/campaigns', [PageController::class, 'campaigns'])->name('campaigns');
Route::get('/transparency', [PageController::class, 'transparency'])->name('transparency');
Route::get('/apply', [PageController::class, 'apply'])->name('apply');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/hadith', [PageController::class, 'hadith'])->name('hadith');
Route::get('/prayer', [PageController::class, 'prayer'])->name('prayer');
Route::get('/prayer-times', function() {
    return redirect()->route('prayer');
});
Route::get('/lectures', [PageController::class, 'lectures'])->name('lectures');
Route::get('/tasbeeh', [PageController::class, 'tasbeeh'])->name('tasbeeh');
Route::get('/azkar', [PageController::class, 'tasbeeh'])->name('azkar'); // Alias

// GUEST AUTH ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/signup', [PageController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signupSubmit'])->name('signup.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PRAYER TIMES API
Route::get('/prayer/api/timings', [PrayerController::class, 'timings'])->name('prayer.timings');
Route::get('/prayer/api/logs', [PrayerController::class, 'logs'])->name('prayer.logs');
Route::post('/prayer/api/location', [PrayerController::class, 'saveLocation'])->name('prayer.location.save');
Route::post('/prayer/api/log', [PrayerController::class, 'storePrayerLog'])->name('prayer.log.store');

// GLOBAL THEME SAVER
Route::post('/admin/settings/theme', [SettingsController::class, 'updateTheme'])->name('admin.theme.save');

// AI COPILOT
use App\Http\Controllers\AiCopilotController;
Route::post('/ai-copilot/chat', [AiCopilotController::class, 'chat'])->name('ai.chat');
Route::get('/ai-copilot/history', [AiCopilotController::class, 'history'])->name('ai.history');

// AUTHENTICATED USER PORTAL
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserPanelController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [UserPanelController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UserPanelController::class, 'profileUpdate'])->name('user.profile.update');
    Route::get('/my-donations', [UserPanelController::class, 'donations'])->name('user.donations');
    Route::get('/my-zakat', [UserPanelController::class, 'zakat'])->name('user.zakat');
    Route::get('/my-prayers', [UserPanelController::class, 'prayers'])->name('user.prayers');
    Route::get('/my-bookmarks', [UserPanelController::class, 'bookmarks'])->name('user.bookmarks');
});

// PARTNER ORGANIZATION PORTAL
Route::middleware(['auth', 'role:organization,admin,super_admin'])->prefix('organization')->group(function () {
    Route::get('/dashboard', [OrganizationPanelController::class, 'dashboard'])->name('org.dashboard');
    Route::get('/campaigns', [OrganizationPanelController::class, 'campaigns'])->name('org.campaigns');
    Route::post('/campaigns/create', [OrganizationPanelController::class, 'createCampaign'])->name('org.campaigns.create');
    Route::get('/donations', [OrganizationPanelController::class, 'donations'])->name('org.donations');
    Route::get('/reports', [OrganizationPanelController::class, 'reports'])->name('org.reports');
});

// SYSTEM ADMINISTRATIVE CONTROL (ADMIN PANEL)
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('admin.users.bulk_delete');
    Route::post('/users/{user}/toggle-verification', [UserController::class, 'toggleVerification'])->name('admin.users.toggle_verification');
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle_status');
    Route::get('/users-export', [UserController::class, 'export'])->name('admin.users.export');

    // Organizations Management
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('admin.organizations.index');
    Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('admin.organizations.create');
    Route::post('/organizations', [OrganizationController::class, 'store'])->name('admin.organizations.store');
    Route::get('/organizations/{organization}', [OrganizationController::class, 'show'])->name('admin.organizations.show');
    Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'edit'])->name('admin.organizations.edit');
    Route::put('/organizations/{organization}', [OrganizationController::class, 'update'])->name('admin.organizations.update');
    Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy'])->name('admin.organizations.destroy');
    Route::post('/organizations/{organization}/approve', [OrganizationController::class, 'approve'])->name('admin.organizations.approve');
    Route::post('/organizations/{organization}/reject', [OrganizationController::class, 'reject'])->name('admin.organizations.reject');

    // Campaigns Management
    Route::get('/campaigns', [CampaignController::class, 'index'])->name('admin.campaigns.index');
    Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('admin.campaigns.create');
    Route::post('/campaigns', [CampaignController::class, 'store'])->name('admin.campaigns.store');
    Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])->name('admin.campaigns.show');
    Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('admin.campaigns.edit');
    Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('admin.campaigns.update');
    Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('admin.campaigns.destroy');
    Route::post('/campaigns/{campaign}/toggle-featured', [CampaignController::class, 'toggleFeatured'])->name('admin.campaigns.toggle_featured');
    Route::post('/campaigns/{campaign}/toggle-urgent', [CampaignController::class, 'toggleUrgent'])->name('admin.campaigns.toggle_urgent');
    Route::post('/campaigns/{campaign}/approve', [CampaignController::class, 'approve'])->name('admin.campaigns.approve');
    Route::post('/campaigns/{campaign}/reject', [CampaignController::class, 'reject'])->name('admin.campaigns.reject');

    // Donations
    Route::get('/donations', [DonationController::class, 'index'])->name('admin.donations.index');
    Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('admin.donations.show');
    Route::post('/donations/{donation}/status', [DonationController::class, 'updateStatus'])->name('admin.donations.status');
    Route::get('/donations-export', [DonationController::class, 'export'])->name('admin.donations.export');

    // Zakat rules and Nisabs
    Route::get('/zakat', [ZakatContentController::class, 'index'])->name('admin.zakat.index');
    Route::put('/zakat/rules/{rule}', [ZakatContentController::class, 'updateRule'])->name('admin.zakat.rules.update');
    Route::put('/zakat/nisab/{nisab}', [ZakatContentController::class, 'updateNisab'])->name('admin.zakat.nisab.update');
    Route::post('/zakat/faqs', [ZakatContentController::class, 'storeFaq'])->name('admin.zakat.faqs.store');
    Route::put('/zakat/faqs/{faq}', [ZakatContentController::class, 'updateFaq'])->name('admin.zakat.faqs.update');
    Route::delete('/zakat/faqs/{faq}', [ZakatContentController::class, 'destroyFaq'])->name('admin.zakat.faqs.destroy');

    // Prayers settings & configs
    Route::get('/prayers', [PrayerManagementController::class, 'index'])->name('admin.prayers.index');
    Route::post('/prayers/settings', [PrayerManagementController::class, 'updateSettings'])->name('admin.prayers.settings.update');

    // Hadiths management
    Route::get('/hadith', [HadithController::class, 'index'])->name('admin.hadith.index');
    Route::get('/hadith/create', [HadithController::class, 'create'])->name('admin.hadith.create');
    Route::post('/hadith', [HadithController::class, 'store'])->name('admin.hadith.store');
    Route::get('/hadith/{hadith}/edit', [HadithController::class, 'edit'])->name('admin.hadith.edit');
    Route::put('/hadith/{hadith}', [HadithController::class, 'update'])->name('admin.hadith.update');
    Route::delete('/hadith/{hadith}', [HadithController::class, 'destroy'])->name('admin.hadith.destroy');
    Route::get('/hadith-categories', [HadithController::class, 'categories'])->name('admin.hadith.categories');
    Route::post('/hadith-categories', [HadithController::class, 'storeCategory'])->name('admin.hadith.categories.store');
    Route::put('/hadith-categories/{category}', [HadithController::class, 'updateCategory'])->name('admin.hadith.categories.update');
    Route::delete('/hadith-categories/{category}', [HadithController::class, 'destroyCategory'])->name('admin.hadith.categories.destroy');

    // Azkar management
    Route::get('/azkar', [AzkarController::class, 'index'])->name('admin.azkar.index');
    Route::get('/azkar/create', [AzkarController::class, 'create'])->name('admin.azkar.create');
    Route::post('/azkar', [AzkarController::class, 'store'])->name('admin.azkar.store');
    Route::get('/azkar/{azkar}/edit', [AzkarController::class, 'edit'])->name('admin.azkar.edit');
    Route::put('/azkar/{azkar}', [AzkarController::class, 'update'])->name('admin.azkar.update');
    Route::delete('/azkar/{azkar}', [AzkarController::class, 'destroy'])->name('admin.azkar.destroy');
    Route::get('/azkar-categories', [AzkarController::class, 'categories'])->name('admin.azkar.categories');
    Route::post('/azkar-categories', [AzkarController::class, 'storeCategory'])->name('admin.azkar.categories.store');
    Route::put('/azkar-categories/{category}', [AzkarController::class, 'updateCategory'])->name('admin.azkar.categories.update');
    Route::delete('/azkar-categories/{category}', [AzkarController::class, 'destroyCategory'])->name('admin.azkar.categories.destroy');

    // Quranic verses management
    Route::get('/quran', [QuranController::class, 'index'])->name('admin.quran.index');
    Route::get('/quran/create', [QuranController::class, 'create'])->name('admin.quran.create');
    Route::post('/quran', [QuranController::class, 'store'])->name('admin.quran.store');
    Route::get('/quran/{verse}/edit', [QuranController::class, 'edit'])->name('admin.quran.edit');
    Route::put('/quran/{verse}', [QuranController::class, 'update'])->name('admin.quran.update');
    Route::delete('/quran/{verse}', [QuranController::class, 'destroy'])->name('admin.quran.destroy');
    Route::get('/quran-topics', [QuranController::class, 'topics'])->name('admin.quran.topics');
    Route::post('/quran-topics', [QuranController::class, 'storeTopic'])->name('admin.quran.topics.store');
    Route::put('/quran-topics/{topic}', [QuranController::class, 'updateTopic'])->name('admin.quran.topics.update');
    Route::delete('/quran-topics/{topic}', [QuranController::class, 'destroyTopic'])->name('admin.quran.topics.destroy');

    // AI Knowledge base
    Route::get('/ai', [AiKnowledgeController::class, 'index'])->name('admin.ai.index');
    Route::get('/ai/create', [AiKnowledgeController::class, 'create'])->name('admin.ai.create');
    Route::post('/ai', [AiKnowledgeController::class, 'store'])->name('admin.ai.store');
    Route::get('/ai/{ai}/edit', [AiKnowledgeController::class, 'edit'])->name('admin.ai.edit');
    Route::put('/ai/{ai}', [AiKnowledgeController::class, 'update'])->name('admin.ai.update');
    Route::delete('/ai/{ai}', [AiKnowledgeController::class, 'destroy'])->name('admin.ai.destroy');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('admin.messages.reply');
    Route::post('/broadcasts', [MessageController::class, 'storeBroadcast'])->name('admin.broadcasts.store');
    Route::delete('/messages/{message}', [MessageController::class, 'destroyMessage'])->name('admin.messages.destroy');
    Route::delete('/broadcasts/{broadcast}', [MessageController::class, 'destroyBroadcast'])->name('admin.broadcasts.destroy');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('admin.reports.export');

    // Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity_logs.index');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [SettingsController::class, 'store'])->name('admin.settings.store');
});
