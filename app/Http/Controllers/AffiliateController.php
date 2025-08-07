<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAffiliateRequest;
use App\Models\Affiliate;
use App\Models\AffiliateProgram;
use App\Models\Commission;
use App\Models\MarketingMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AffiliateController extends Controller
{
    /**
     * Display the affiliate dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $affiliate = Affiliate::where('user_id', $user->id)->first();

        if (!$affiliate) {
            return Inertia::render('affiliate/register');
        }

        // Get affiliate statistics
        $totalClicks = $affiliate->clicks()->count();
        $totalConversions = $affiliate->orders()->where('status', 'confirmed')->count();
        $pendingEarnings = $affiliate->commissions()->where('status', 'pending')->sum('commission_amount');
        $conversionRate = $totalClicks > 0 ? round(($totalConversions / $totalClicks) * 100, 2) : 0;

        $stats = [
            'total_clicks' => $totalClicks,
            'total_conversions' => $totalConversions,
            'total_earnings' => $affiliate->total_commissions_earned,
            'pending_earnings' => $pendingEarnings,
            'paid_earnings' => $affiliate->total_commissions_paid,
            'conversion_rate' => $conversionRate,
        ];

        // Get recent commissions
        $recentCommissions = $affiliate->commissions()
            ->with(['order.affiliateProgram'])
            ->latest()
            ->limit(5)
            ->get();

        // Get affiliate links
        $affiliateLinks = $affiliate->affiliateLinks()
            ->with('affiliateProgram')
            ->where('is_active', true)
            ->get();

        return Inertia::render('affiliate/dashboard', [
            'affiliate' => $affiliate,
            'stats' => $stats,
            'recent_commissions' => $recentCommissions,
            'affiliate_links' => $affiliateLinks,
        ]);
    }

    /**
     * Show the affiliate registration form.
     */
    public function create()
    {
        return Inertia::render('affiliate/register');
    }

    /**
     * Store a newly created affiliate.
     */
    public function store(StoreAffiliateRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $affiliate = Affiliate::create([
            'user_id' => $user->id,
            'affiliate_code' => 'EB-' . Str::upper(Str::random(8)),
            'full_name' => $request->validated()['full_name'],
            'phone' => $request->validated()['phone'],
            'bank_name' => $request->validated()['bank_name'],
            'bank_account_number' => $request->validated()['bank_account_number'],
            'bank_account_holder' => $request->validated()['bank_account_holder'],
            'status' => 'pending',
        ]);

        // Create default affiliate links for popular programs
        $popularPrograms = AffiliateProgram::whereIn('category', [
            'General English', 'TOEFL', 'Speaking Booster'
        ])->active()->get();

        foreach ($popularPrograms as $program) {
            $affiliate->affiliateLinks()->create([
                'affiliate_program_id' => $program->id,
                'link_code' => Str::random(12),
                'original_url' => url("/programs/{$program->id}"),
                'campaign' => 'default',
            ]);
        }

        return redirect()->route('affiliate.dashboard')
            ->with('success', 'Affiliate registration submitted successfully! Please wait for approval.');
    }

    /**
     * Display the affiliate links page.
     */
    public function show()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $affiliate = Affiliate::where('user_id', $user->id)->first();
        
        if (!$affiliate || $affiliate->status !== 'active') {
            return redirect()->route('affiliate.dashboard')
                ->with('error', 'Your affiliate account must be active to access links.');
        }

        $programs = AffiliateProgram::active()->get();
        $affiliateLinks = $affiliate->affiliateLinks()
            ->with('affiliateProgram')
            ->get();

        return Inertia::render('affiliate/links', [
            'programs' => $programs,
            'affiliate_links' => $affiliateLinks,
            'affiliate_code' => $affiliate->affiliate_code,
            'base_url' => url('/'),
        ]);
    }

    /**
     * Generate a new affiliate link.
     */
    public function update(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:affiliate_programs,id',
            'campaign' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $affiliate = Affiliate::where('user_id', $user->id)->first();
        
        if (!$affiliate || $affiliate->status !== 'active') {
            return back()->with('error', 'Your affiliate account must be active to generate links.');
        }

        $program = AffiliateProgram::findOrFail($request->input('program_id'));
        
        $affiliate->affiliateLinks()->create([
            'affiliate_program_id' => $program->id,
            'link_code' => Str::random(12),
            'original_url' => url("/programs/{$program->id}"),
            'campaign' => $request->input('campaign', 'custom'),
        ]);

        return back()->with('success', 'Affiliate link generated successfully!');
    }

    /**
     * Display commission history.
     */
    public function edit()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $affiliate = Affiliate::where('user_id', $user->id)->first();
        
        if (!$affiliate) {
            return redirect()->route('affiliate.dashboard');
        }

        $commissions = $affiliate->commissions()
            ->with(['order.affiliateProgram'])
            ->latest()
            ->paginate(20);

        return Inertia::render('affiliate/commissions', [
            'commissions' => $commissions,
        ]);
    }

    /**
     * Display payout history.
     */
    public function destroy()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $affiliate = Affiliate::where('user_id', $user->id)->first();
        
        if (!$affiliate) {
            return redirect()->route('affiliate.dashboard');
        }

        $payouts = $affiliate->payouts()
            ->latest()
            ->paginate(20);

        $pendingAmount = $affiliate->commissions()->where('status', 'approved')->sum('commission_amount');

        return Inertia::render('affiliate/payouts', [
            'payouts' => $payouts,
            'pending_amount' => $pendingAmount,
            'minimum_payout' => $affiliate->minimum_payout,
        ]);
    }
}