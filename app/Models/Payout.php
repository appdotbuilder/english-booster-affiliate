<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Payout
 *
 * @property int $id
 * @property int $affiliate_id
 * @property string $payout_number
 * @property string $amount
 * @property string $status
 * @property string $method
 * @property string $bank_name
 * @property string $bank_account_number
 * @property string $bank_account_holder
 * @property string|null $notes
 * @property array $commission_ids
 * @property \Illuminate\Support\Carbon|null $processed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate $affiliate
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Payout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereBankAccountHolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereCommissionIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout wherePayoutNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereProcessedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payout pending()
 * @method static \Database\Factories\PayoutFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Payout extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'affiliate_id',
        'payout_number',
        'amount',
        'status',
        'method',
        'bank_name',
        'bank_account_number',
        'bank_account_holder',
        'notes',
        'commission_ids',
        'processed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'commission_ids' => 'array',
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include pending payouts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Get the affiliate that owns the payout.
     */
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }
}