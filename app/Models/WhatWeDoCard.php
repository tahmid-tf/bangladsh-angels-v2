<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WhatWeDoCard extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const MEDIA_COVER = 'cover';

    public const SLUG_BWIN = 'bwin';

    protected $fillable = [
        'slug',
        'title',
        'description',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COVER)
            ->singleFile()
            ->useDisk('public');
    }

    /**
     * Public cover URL: uploaded media, else legacy BWIN asset for the BWIN card, else site placeholder.
     */
    public function coverImageUrl(): string
    {
        $media = $this->getFirstMedia(self::MEDIA_COVER);
        if ($media) {
            return $media->getUrl();
        }

        if ($this->slug === self::SLUG_BWIN && is_file(public_path('bwin.png'))) {
            return asset('bwin.png');
        }

        return asset('what-we-do-placeholder.svg');
    }
}
