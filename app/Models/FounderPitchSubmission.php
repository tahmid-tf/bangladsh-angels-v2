<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FounderPitchSubmission extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const MEDIA_PITCH_DECK = 'pitch_deck';

    protected $fillable = [
        'user_id',
        'contact_email',
        'one_line',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_PITCH_DECK)
            ->useDisk('local')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
