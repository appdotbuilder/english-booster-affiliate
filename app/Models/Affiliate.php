<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Affiliate
 *
 * @property int $id
 * @property int $user_id
 * @property string $affiliate_code
 * @property string $full_name
 * @property string $phone
 * @property string|null $bank_name
 * @property string|null $bank_account_number
 * @property string|null $bank_account_holder
 * @property string $status
 * @property string $tier
 * @property string $total_commissions_earned
 * @property string $total_commissions_paid
 * @property string $minimum_payout
 * @property array|null $marketing_preferences
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AffiliateLink> $affiliateLinks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AffiliateClick> $clicks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commission> $commissions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payout> $payouts
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereAffiliateCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereBankAccountHolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereMarketingPreferences($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereMinimumPayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereTier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereTotalCommissionsEarned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereTotalCommissionsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Affiliate active()
 * @method static \Database\Factories\AffiliateFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Affiliate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'affiliate_code',
        'full_name',
        'phone',
        'bank_name',
        'bank_account_number',
        'bank_account_holder',
        'status',
        'tier',
        'total_commissions_earned',
        'total_commissions_paid',
        'minimum_payout',
        'marketing_preferences',
        'approved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_commissions_earned' => 'decimal:2',
        'total_commissions_paid' => 'decimal:2',
        'minimum_payout' => 'decimal:2',
        'marketing_preferences' => 'array',
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active affiliates.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the user that owns the affiliate.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the affiliate links for the affiliate.
     */
    public function affiliateLinks(): HasMany
    {
        return $this->hasMany(AffiliateLink::class);
    }

    /**
     * Get the clicks for the affiliate.
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(AffiliateClick::class);
    }

    /**
     * Get the commissions for the affiliate.
     */
    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }

    /**
     * Get the orders for the affiliate.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the payouts for the affiliate.
     */
    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }
}