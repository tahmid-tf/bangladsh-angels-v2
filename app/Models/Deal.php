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
        'investment_stage',
        'amount_seeking',
        'company_logo',
        'company_banner',
        'pitch_deck_url',
        'created_by',
        'status',
        'slug',
        'monthly_revenue',
        'total_addressable_market',
        'serviceable_addressable_market',
        'growth_rate',
        'revenue_model',
        'user_base',
        'daily_active_users',
        'market_penetration',
        'time_saved',
        'carbon_emission_reduction',
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
}
