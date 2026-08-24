<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('kicker', 160);
            $table->string('heading');
            $table->json('body');
            $table->string('image_alt');
            $table->string('image_badge', 160);
            $table->timestamps();
        });

        DB::table('team_about_sections')->insert([
            'kicker' => 'About Bangladesh Angels Network',
            'heading' => 'What is Bangladesh Angels Network?',
            'body' => json_encode([
                'BAN is the country’s first and largest angel-investing platform, connecting visionary entrepreneurs with seasoned investors and fostering an ecosystem that drives innovation and economic growth.',
                'With more than $12 million invested across 50+ startups, we combine capital with mentorship, strategic guidance, and meaningful connections. Our local and global members work alongside founders to help promising ventures solve real problems and scale with purpose.',
                'We do more than invest—we help build, nurture, and accelerate companies with the potential to reshape industries.',
            ], JSON_UNESCAPED_UNICODE),
            'image_alt' => 'Founders and investors sharing experience at a BAN ecosystem event',
            'image_badge' => 'Capital. Community. Conviction.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('team_about_sections');
    }
};
