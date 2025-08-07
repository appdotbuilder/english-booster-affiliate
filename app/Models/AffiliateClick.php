<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AffiliateClick
 *
 * @property int $id
 * @property int $affiliate_id
 * @property int $affiliate_link_id
 * @property string $ip_address
 * @property string|null $user_agent
 * @property string|null $referrer
 * @property string|null $utm_source
 * @property string|null $utm_medium
 * @property string|null $utm_campaign
 * @property string|null $session_id
 * @property array|null $tracking_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate $affiliate
 * @property-read \App\Models\AffiliateLink $affiliateLink
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick query()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereAffiliateLinkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereReferrer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereTrackingData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereUtmCampaign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereUtmMedium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateClick whereUtmSource($value)
 * @method static \Database\Factories\AffiliateClickFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class AffiliateClick extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'affiliate_id',
        'affiliate_link_id',
        'ip_address',
        'user_agent',
        'referrer',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'session_id',
        'tracking_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tracking_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the affiliate that owns the click.
     */
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    /**
     * Get the affiliate link that owns the click.
     */
    public function affiliateLink(): BelongsTo
    {
        return $this->belongsTo(AffiliateLink::class);
    }
}