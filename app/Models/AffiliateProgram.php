<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\AffiliateProgram
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $category
 * @property string|null $location
 * @property string|null $description
 * @property string $base_price
 * @property string $commission_rate
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AffiliateLink> $affiliateLinks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereBasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AffiliateProgram active()
 * @method static \Database\Factories\AffiliateProgramFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class AffiliateProgram extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
        'category',
        'location',
        'description',
        'base_price',
        'commission_rate',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'base_price' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active programs.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the affiliate links for the program.
     */
    public function affiliateLinks(): HasMany
    {
        return $this->hasMany(AffiliateLink::class);
    }

    /**
     * Get the orders for the program.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}