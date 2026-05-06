<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Queue throttle for outbound campaign jobs (adjust per provider limits).
        RateLimiter::for('campaign-mails', function (): Limit {
            return Limit::perMinute(50)->by('global-campaign-mails');
        });
    }
}
