<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resource_hub_cards', function (Blueprint $table) {
            $table->string('cta_label', 120)->nullable()->after('link');
        });

        DB::table('resource_hub_cards')->update(['cta_label' => 'Learn more']);
    }

    public function down(): void
    {
        Schema::table('resource_hub_cards', function (Blueprint $table) {
            $table->dropColumn('cta_label');
        });
    }
};
