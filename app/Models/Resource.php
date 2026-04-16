<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Resource extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'type',
        'date',
        'start_time',
        'end_time',
        'location',
        'registration_fee',
        'benefits',
        'event_highlights',
        'target_audience',
        'registration_details',
        'speakers',
        'cta_link',
        'show_on_landing',
    ];

    protected $casts = [
        'benefits' => 'array',
        'event_highlights' => 'array',
        'target_audience' => 'array',
        'speakers' => 'array',
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'registration_fee' => 'decimal:2',
        'show_on_landing' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('banner')
            ->singleFile()
            ->useDisk('public');

        $this->addMediaCollection('speakers')
            ->useDisk('public');
    }

    /**
     * Banner for list cards: uploaded media, else legacy BWIN asset if present, else shared placeholder.
     */
    public function cardBannerUrl(): string
    {
        $media = $this->getFirstMedia('banner');
        if ($media !== null) {
            return $media->getUrl();
        }

        if (is_file(public_path('bwin.png'))) {
            return asset('bwin.png');
        }

        return asset('what-we-do-placeholder.svg');
    }
}
