<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Deal extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'type',
        'key_metrics',
        'investment_stage',
        'amount_seeking',
        'company_logo',
        'company_cover',
        'pitch_deck_url',
        'created_by',
        'status',
        'slug',
        'monthly_revenue',
        'growth_rate',
        'revenue_model',
        'future_plans',
        'partnerships',
        'video_url',
        'image_gallery',
        'likes',
        'views',
        'investor_commits',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getKeyMetrics()
    {
        // Decode the JSON key_metrics field
        $keyMetrics = json_decode($this->key_metrics, true);

        // Ensure it returns an array, even if the field is empty or null
        return $keyMetrics ?? [];
    }
}
