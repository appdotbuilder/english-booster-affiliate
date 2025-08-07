<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MarketingMaterial
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string|null $format
 * @property string|null $content
 * @property string|null $file_path
 * @property string|null $preview_image
 * @property array|null $dimensions
 * @property array|null $program_types
 * @property string|null $description
 * @property int $download_count
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial query()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereDimensions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereDownloadCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial wherePreviewImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereProgramTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketingMaterial active()
 * @method static \Database\Factories\MarketingMaterialFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class MarketingMaterial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'type',
        'format',
        'content',
        'file_path',
        'preview_image',
        'dimensions',
        'program_types',
        'description',
        'download_count',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dimensions' => 'array',
        'program_types' => 'array',
        'download_count' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active materials.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}