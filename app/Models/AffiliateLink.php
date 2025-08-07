<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\AffiliateLink
 *
 * @property int $id
 * @property int $affiliate_id
 * @property int $affiliate_program_id
 * @property string $link_code
 * @property string $original_url
 * @property string|null $campaign
 * @property int $clicks
 * @property int $conversions
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate $affiliate
 * @property-read \App\Models\AffiliateProgram $affiliateProgram
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AffiliateClick> $linkClicks
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereAffiliateProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereCampaign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereConversions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereLinkCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereOriginalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateLink active()
 * @method static \Database\Factories\AffiliateLinkFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class AffiliateLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'affiliate_id',
        'affiliate_program_id',
        'link_code',
        'original_url',
        'campaign',
        'clicks',
        'conversions',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'clicks' => 'integer',
        'conversions' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active links.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the affiliate that owns the link.
     */
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    /**
     * Get the affiliate program that owns the link.
     */
    public function affiliateProgram(): BelongsTo
    {
        return $this->belongsTo(AffiliateProgram::class);
    }

    /**
     * Get the clicks for the affiliate link.
     */
    public function linkClicks(): HasMany
    {
        return $this->hasMany(AffiliateClick::class);
    }
}