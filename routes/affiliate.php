<?php

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\MarketingMaterialController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Affiliate Routes
|--------------------------------------------------------------------------
|
| Here is where you can register affiliate routes for your application.
|
*/

// Public tracking routes
Route::get('/track/{link_code}', [TrackingController::class, 'show'])->name('affiliate.track');
Route::get('/ref/{affiliate_code}', [TrackingController::class, 'index'])->name('affiliate.referral');

// Authenticated affiliate routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/affiliate', [AffiliateController::class, 'index'])->name('affiliate.dashboard');
    Route::get('/affiliate/create', [AffiliateController::class, 'create'])->name('affiliate.register');
    Route::post('/affiliate', [AffiliateController::class, 'store'])->name('affiliate.store');
    Route::get('/affiliate/links', [AffiliateController::class, 'show'])->name('affiliate.links');
    Route::post('/affiliate/links', [AffiliateController::class, 'update'])->name('affiliate.generate-link');
    Route::get('/affiliate/commissions', [AffiliateController::class, 'edit'])->name('affiliate.commissions');
    Route::get('/affiliate/payouts', [AffiliateController::class, 'destroy'])->name('affiliate.payouts');
    Route::get('/affiliate/materials', [MarketingMaterialController::class, 'index'])->name('affiliate.materials');
});