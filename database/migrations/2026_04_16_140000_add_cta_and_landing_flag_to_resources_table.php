<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->string('cta_link', 2048)->nullable()->after('registration_details');
            $table->boolean('show_on_landing')->default(false)->after('cta_link');
        });
    }

    public function down(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn(['cta_link', 'show_on_landing']);
        });
    }
};
