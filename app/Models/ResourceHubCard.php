<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ResourceHubCard extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const MEDIA_LOGO = 'logo';

    protected $fillable = [
        'title',
        'one_liner',
        'link',
        'cta_label',
        'cta_link',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_LOGO)
            ->singleFile()
            ->useDisk('public');
    }

    public function logoUrl(): string
    {
        $media = $this->getFirstMedia(self::MEDIA_LOGO);

        return $media ? $media->getUrl() : '';
    }
}
