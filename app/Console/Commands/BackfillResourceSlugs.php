<?php

namespace App\Console\Commands;

use App\Models\Resource;
use Illuminate\Console\Command;

class BackfillResourceSlugs extends Command
{
    protected $signature = 'resources:backfill-slugs {--dry-run : List changes without saving}';

    protected $description = 'Assign URL slugs to resources that are missing one (based on title)';

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');

        $query = Resource::query()->where(function ($q) {
            $q->whereNull('slug')->orWhere('slug', '');
        });

        $count = $query->count();
        if ($count === 0) {
            $this->info('No resources need a slug.');

            return self::SUCCESS;
        }

        $this->info(($dry ? 'Would update' : 'Updating')." {$count} resource(s).");

        foreach ($query->orderBy('id')->cursor() as $resource) {
            $base = Resource::slugBaseFromTitle((string) $resource->title);
            $slug = Resource::makeUniqueSlug($base, $resource->id);

            if ($dry) {
                $this->line("#{$resource->id} «{$resource->title}» → [{$slug}]");

                continue;
            }

            $resource->slug = $slug;
            $resource->saveQuietly();
        }

        if (! $dry) {
            $this->info('Done.');
        }

        return self::SUCCESS;
    }
}
