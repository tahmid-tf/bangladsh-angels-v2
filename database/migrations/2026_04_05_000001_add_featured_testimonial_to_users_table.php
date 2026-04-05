<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('featured_testimonial')->nullable()->after('featured');
            $table->boolean('featured_testimonial_public')->default(false)->after('featured_testimonial');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['featured_testimonial', 'featured_testimonial_public']);
        });
    }
};
