<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('resource_hub_cards')
            ->where('title', 'DeckVue')
            ->update([
                'title' => 'Resources',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        DB::table('resource_hub_cards')
            ->where('title', 'Resources')
            ->where('link', 'https://deckvue.ai')
            ->update([
                'title' => 'DeckVue',
                'updated_at' => now(),
            ]);
    }
};
