<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'investor', 'seeker'])->default('investor'); // Enum for roles
            $table->boolean('is_approved')->default(false); // Default: not approved

            $table->string('company_name')->nullable();
            $table->string('website_link')->nullable();
            $table->string('designation')->nullable();
            $table->string('primary_country')->nullable();
            $table->string('secondary_countries')->nullable(); // Comma-separated list
            $table->string('linkedin')->nullable();
            $table->string('investment_expertise')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'company_name',
                'website_link',
                'designation',
                'primary_country',
                'secondary_countries',
                'linkedin',
                'investment_expertise',
                'is_approved',
            ]);
        });
    }
};
