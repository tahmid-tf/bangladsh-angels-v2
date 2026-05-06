<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Deal extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'sector',
        'type',
        'key_metrics',
        'investment_stage',
        'amount_seeking',
        'company_logo',
        'company_cover',
        'pitch_deck_url',
        'substack_link',
        'invest_link',
        'commit_link',
        'groupchat_invite_link',
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

    public function getLogoUrl(): string
    {
        $media = $this->getFirstMedia('company_logo');

        // Return the URL if media exists, otherwise return a default placeholder
        return $media ? $media->getUrl() : asset('default_pfp.jpg');
    }

    public function amountSeeking(): string
    {
        return number_format((float) $this->amount_seeking, 0, '.', ',');
    }

    public function getCoverUrl(): string
    {
        $media = $this->getFirstMedia('company_cover');

        // Return the URL if media exists, otherwise return a default placeholder
        return $media ? $media->getUrl() : asset('default_pfp.jpg');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function hasKeyMetric(): bool
    {
        // Decode the JSON value from the key_metrics column
        $keyMetrics = json_decode($this->key_metrics, true);

        // Check if key_metrics is not a valid array or empty
        if (! is_array($keyMetrics) || empty($keyMetrics)) {
            return false; // Invalid key metrics
        }

        // Check if the key_metrics contains only one item with null values
        foreach ($keyMetrics as $metric) {
            if (isset($metric['name'], $metric['value'])) {
                if ($metric['name'] !== null || $metric['value'] !== null) {
                    return true; // Valid key metric found
                }
            }
        }

        return false; // No valid key metrics found
    }

    public function getKeyMetrics()
    {
        // Decode the JSON key_metrics field
        $keyMetrics = json_decode($this->key_metrics, true);

        // Ensure it returns an array, even if the field is empty or null
        return $keyMetrics ?? [];
    }

    public function getOtherDeals($limit = 5)
    {
        if (auth()->user()) {
            if (auth()->user()->isFree()) {
                return self::where('id', '!=', $this->id)
                    ->where('type', 'portfolio')
                    ->orderBy('created_at', 'desc') // Order by the most recently created
                    ->take($limit) // Limit the number of deals fetched
                    ->get();
            } else {
                // Paid members: only active “live” deals—exclude portfolio companies from this list.
                return self::where('id', '!=', $this->id)
                    ->where('type', '!=', 'portfolio')
                    ->where('status', 'active')
                    ->orderBy('created_at', 'desc')
                    ->take($limit)
                    ->get();
            }

        } else {
            return self::where('id', '!=', $this->id)
                ->where('type', 'portfolio')
                ->orderBy('created_at', 'desc') // Order by the most recently created
                ->take($limit) // Limit the number of deals fetched
                ->get();
        }

    }

    public function getExcerpt(): string
    {
        $excerpt = Str::limit($this->description, 75, '...');

        if (strlen($this->description) > 75) {
            return $excerpt.' [Read more]';
        }

        return $excerpt;
    }

    public function investments()
    {
        return $this->hasMany(Investment::class, 'deal_id');
    }

    public function commits()
    {
        return $this->hasMany(Commit::class);
    }

    public function investorsCount()
    {
        return $this->investments()->where('type', 'invest')->count();
    }

    public function commitCount()
    {
        return $this->investments()->where('type', 'commit')->count();
    }

    public function reviewCount()
    {
        return $this->investments()->where('type', 'review')->count();
    }

    public function updateLogo($file)
    {
        // Remove the old logo if exists
        $this->clearMediaCollection('company_logo');

        // Add new logo to media library
        $this->addMedia($file)
            ->toMediaCollection('company_logo');
    }

    public function updateCover($file)
    {
        // Remove the old cover if exists
        $this->clearMediaCollection('company_cover');

        // Add new cover to media library
        $this->addMedia($file)
            ->toMediaCollection('company_cover');
    }
}
