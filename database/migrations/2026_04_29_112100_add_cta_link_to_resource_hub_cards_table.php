<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resource_hub_cards', function (Blueprint $table) {
            $table->string('cta_link', 2048)->nullable()->after('cta_label');
        });
    }

    public function down(): void
    {
        Schema::table('resource_hub_cards', function (Blueprint $table) {
            $table->dropColumn('cta_link');
        });
    }
};
