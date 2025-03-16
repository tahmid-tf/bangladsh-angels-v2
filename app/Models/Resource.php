<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
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
    ];
    
    protected $casts = [
        'benefits'          => 'array',
        'event_highlights'  => 'array',
        'target_audience'   => 'array',
        'speakers'          => 'array',
        'date'              => 'date',
        'start_time'        => 'datetime:H:i',
        'end_time'          => 'datetime:H:i',
        'registration_fee'  => 'decimal:2',
    ];

    public function registerMediaCollections(): void
    {
        // For the main banner/featured image
        $this->addMediaCollection('banner')->singleFile();

        // For multiple speaker images
        $this->addMediaCollection('speakers');
    }
}
