<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('founder_pitch_submissions', 'deck_path')) {
            Schema::table('founder_pitch_submissions', function (Blueprint $table) {
                $table->dropColumn('deck_path');
            });
        }
    }

    public function down(): void
    {
        Schema::table('founder_pitch_submissions', function (Blueprint $table) {
            $table->string('deck_path')->nullable()->after('one_line');
        });
    }
};
