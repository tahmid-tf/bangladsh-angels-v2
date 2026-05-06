<?php

namespace App\Console\Commands;

use App\Models\Deal;
use Illuminate\Console\Command;

class BackfillDealSlugs extends Command
{
    protected $signature = 'deals:backfill-slugs {--dry-run : List changes without saving}';

    protected $description = 'Assign URL slugs to deals missing one (based on title; avoids collisions and reserved /deals paths)';

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');

        $query = Deal::query()->where(function ($q) {
            $q->whereNull('slug')->orWhere('slug', '');
        });

        $count = $query->count();
        if ($count === 0) {
            $this->info('No deals need a slug.');

            return self::SUCCESS;
        }

        $this->info(($dry ? 'Would update' : 'Updating')." {$count} deal(s).");

        foreach ($query->orderBy('id')->cursor() as $deal) {
            $base = Deal::slugBaseFromTitle((string) $deal->title);
            $slug = Deal::makeUniqueSlug($base, $deal->id);

            if ($dry) {
                $this->line("#{$deal->id} «{$deal->title}» → [{$slug}]");

                continue;
            }

            $deal->slug = $slug;
            $deal->saveQuietly();
        }

        if (! $dry) {
            $this->info('Done.');
        }

        return self::SUCCESS;
    }
}
