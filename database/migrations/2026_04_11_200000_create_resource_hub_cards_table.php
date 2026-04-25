<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resource_hub_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('one_liner');
            $table->string('link', 2048);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        DB::table('resource_hub_cards')->insert([
            [
                'title' => 'Angel Academy',
                'one_liner' => 'Structured investor education for people who want to back early-stage companies with confidence.',
                'link' => 'mailto:hello@bdangels.co?subject=Angel%20Academy%20%E2%80%94%20call%20request',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'BWIN',
                'one_liner' => 'Bangladesh Women Investors Network — our sister chapter growing women investors and gender-lens deal flow.',
                'link' => 'mailto:hello@bdangels.co?subject=BWIN%20%E2%80%94%20join%20form%20request',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Resources',
                'one_liner' => 'AI-assisted deck feedback so founders can sharpen their story before investors see it.',
                'link' => 'https://deckvue.ai',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('resource_hub_cards');
    }
};
