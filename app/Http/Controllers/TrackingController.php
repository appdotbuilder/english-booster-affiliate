<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateClick;
use App\Models\AffiliateLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class TrackingController extends Controller
{
    /**
     * Track affiliate link clicks.
     */
    public function show(Request $request, $link_code)
    {
        $affiliate_link = AffiliateLink::where('link_code', $link_code)
            ->with(['affiliate', 'affiliateProgram'])
            ->first();

        if (!$affiliate_link || !$affiliate_link->is_active) {
            return redirect('/')->with('error', 'Invalid affiliate link.');
        }

        // Track the click
        $this->recordClick($request, $affiliate_link);

        // Set affiliate cookies for tracking
        $this->setAffiliateTracking($affiliate_link, $request);

        // Redirect to the target URL
        $target_url = $this->buildTargetUrl($affiliate_link, $request);
        
        return redirect($target_url);
    }

    /**
     * Handle referral code tracking.
     */
    public function index(Request $request, $affiliate_code)
    {
        $affiliate = Affiliate::where('affiliate_code', $affiliate_code)
            ->where('status', 'active')
            ->first();

        if (!$affiliate) {
            return redirect('/')->with('error', 'Invalid affiliate code.');
        }

        // Set affiliate cookies for general referral tracking
        $cookie_data = [
            'affiliate_id' => $affiliate->id,
            'affiliate_code' => $affiliate->affiliate_code,
            'referral_type' => 'general',
            'utm_source' => $request->get('utm_source', 'affiliate'),
            'utm_medium' => $request->get('utm_medium', 'referral'),
            'utm_campaign' => $request->get('utm_campaign', 'general'),
            'timestamp' => now()->timestamp,
        ];

        $cookie = Cookie::make(
            'eb_affiliate_tracking',
            encrypt(json_encode($cookie_data)),
            60 * 24 * 30 // 30 days
        );

        // Redirect to home page or specified URL
        $redirect_url = $request->get('redirect', '/');
        
        return redirect($redirect_url)->withCookie($cookie);
    }

    /**
     * Record affiliate click.
     */
    protected function recordClick(Request $request, AffiliateLink $affiliate_link)
    {
        // Check for duplicate clicks from same IP within 1 hour (anti-fraud)
        $recent_click = AffiliateClick::where('affiliate_link_id', $affiliate_link->id)
            ->where('ip_address', $request->ip())
            ->where('created_at', '>', now()->subHour())
            ->first();

        if ($recent_click) {
            return; // Don't record duplicate clicks
        }

        // Create click record
        AffiliateClick::create([
            'affiliate_id' => $affiliate_link->affiliate_id,
            'affiliate_link_id' => $affiliate_link->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referrer' => $request->header('referer'),
            'utm_source' => $request->get('utm_source'),
            'utm_medium' => $request->get('utm_medium'),
            'utm_campaign' => $request->get('utm_campaign'),
            'session_id' => session()->getId(),
            'tracking_data' => [
                'query_params' => $request->query(),
                'headers' => [
                    'accept_language' => $request->header('accept-language'),
                    'accept_encoding' => $request->header('accept-encoding'),
                ],
            ],
        ]);

        // Update link click count
        $affiliate_link->increment('clicks');
    }

    /**
     * Set affiliate tracking cookies.
     */
    protected function setAffiliateTracking(AffiliateLink $affiliate_link, Request $request)
    {
        $cookie_data = [
            'affiliate_id' => $affiliate_link->affiliate_id,
            'affiliate_code' => $affiliate_link->affiliate->affiliate_code,
            'affiliate_link_id' => $affiliate_link->id,
            'program_id' => $affiliate_link->affiliate_program_id,
            'link_code' => $affiliate_link->link_code,
            'campaign' => $affiliate_link->campaign,
            'utm_source' => $request->get('utm_source', 'affiliate'),
            'utm_medium' => $request->get('utm_medium', 'link'),
            'utm_campaign' => $request->get('utm_campaign', $affiliate_link->campaign),
            'timestamp' => now()->timestamp,
            'click_id' => Str::uuid()->toString(),
        ];

        // Set first-click tracking (if not already set)
        if (!$request->hasCookie('eb_first_click')) {
            $first_click_cookie = Cookie::make(
                'eb_first_click',
                encrypt(json_encode($cookie_data)),
                60 * 24 * 30 // 30 days
            );
            
            Cookie::queue($first_click_cookie);
        }

        // Set last-click tracking (always update)
        $last_click_cookie = Cookie::make(
            'eb_last_click',
            encrypt(json_encode($cookie_data)),
            60 * 24 * 7 // 7 days
        );
        
        Cookie::queue($last_click_cookie);

        // Set general affiliate tracking
        $affiliate_cookie = Cookie::make(
            'eb_affiliate_tracking',
            encrypt(json_encode($cookie_data)),
            60 * 24 * 30 // 30 days
        );
        
        Cookie::queue($affiliate_cookie);
    }

    /**
     * Build target URL with tracking parameters.
     */
    protected function buildTargetUrl(AffiliateLink $affiliate_link, Request $request)
    {
        $url = $affiliate_link->original_url;
        
        // Add tracking parameters
        $params = [
            'ref' => $affiliate_link->affiliate->affiliate_code,
            'utm_source' => 'affiliate',
            'utm_medium' => 'link',
            'utm_campaign' => $affiliate_link->campaign,
            'utm_content' => $affiliate_link->link_code,
        ];

        // Preserve existing query parameters from the original request
        $existing_params = $request->query();
        foreach ($existing_params as $key => $value) {
            if (!isset($params[$key])) {
                $params[$key] = $value;
            }
        }

        // Build final URL
        $query_string = http_build_query($params);
        $separator = strpos($url, '?') !== false ? '&' : '?';
        
        return $url . $separator . $query_string;
    }
}