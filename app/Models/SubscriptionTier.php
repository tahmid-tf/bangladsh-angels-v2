<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SubscriptionTier extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'price_yearly',
        'is_active',
        'sort_order',
        'is_highlighted',
        'features_included',
        'features_excluded',
    ];

    protected function casts(): array
    {
        return [
            'price_yearly' => 'decimal:2',
            'is_active' => 'boolean',
            'is_highlighted' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * @return list<string>
     */
    public function includedFeatureLines(): array
    {
        return $this->nonEmptyLines($this->features_included);
    }

    /**
     * @return list<string>
     */
    public function excludedFeatureLines(): array
    {
        return $this->nonEmptyLines($this->features_excluded);
    }

    /**
     * @return list<string>
     */
    protected function nonEmptyLines(?string $text): array
    {
        if ($text === null || trim($text) === '') {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $text) ?: [])));
    }

    public function iconAsset(): string
    {
        return asset('plan_'.$this->slug.'.webp');
    }
}
