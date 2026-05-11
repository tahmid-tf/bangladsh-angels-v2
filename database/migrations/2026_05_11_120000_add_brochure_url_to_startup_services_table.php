<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('startup_services', function (Blueprint $table) {
            $table->string('brochure_url', 2048)->nullable()->after('show_brochure_link');
        });
    }

    public function down(): void
    {
        Schema::table('startup_services', function (Blueprint $table) {
            $table->dropColumn('brochure_url');
        });
    }
};
