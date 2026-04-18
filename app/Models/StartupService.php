<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class StartupService extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const MEDIA_LOGO = 'logo';

    protected $fillable = [
        'title',
        'intro',
        'bullets',
        'footer_note',
        'link',
        'cta_label',
        'show_brochure_link',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'bullets' => 'array',
            'show_brochure_link' => 'boolean',
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

    /**
     * @return list<string>
     */
    public function bulletList(): array
    {
        $b = $this->bullets;

        return is_array($b) ? array_values(array_filter($b, fn ($item) => is_string($item) && $item !== '')) : [];
    }
}
