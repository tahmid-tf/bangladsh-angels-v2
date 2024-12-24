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
        Schema::create('deals', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('title'); // Deal Title
            $table->text('description')->nullable(); // Deal Description
            $table->enum('type', ['commit', 'invest', 'review']); // Deal Type
            $table->enum('investment_stage', ['Pre Seed', 'Seed', 'Series A', 'Series B'])->nullable(); // Investment Stage
            $table->decimal('amount_seeking', 15, 2)->nullable(); // Amount Being Sought
            $table->string('company_logo')->nullable(); // Path to Company Logo
            $table->string('company_banner')->nullable(); // Path to Company Banner
            $table->string('pitch_deck_url')->nullable(); // URL to Pitch Deck
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // User who created the deal
            $table->enum('status', ['active', 'closed', 'draft'])->default('draft'); // Deal Status
            $table->string('slug')->unique(); // Unique Slug for URLs
            $table->decimal('monthly_revenue', 15, 2)->nullable(); // Monthly Revenue
            $table->string('total_addressable_market')->nullable(); // TAM
            $table->string('serviceable_addressable_market')->nullable(); // SAM
            $table->string('growth_rate')->nullable(); // Growth Rate
            $table->text('revenue_model')->nullable(); // Revenue Model
            $table->string('user_base')->nullable(); // Registered Users
            $table->string('daily_active_users')->nullable(); // DAU
            $table->string('market_penetration')->nullable(); // Market Penetration Details
            $table->string('time_saved')->nullable(); // Time Saved Annually
            $table->string('carbon_emission_reduction')->nullable(); // CO2 Reduction Metrics
            $table->text('future_plans')->nullable(); // Future Plans
            $table->text('partnerships')->nullable(); // Partnerships/Collaborations
            $table->string('video_url')->nullable(); // URL to Promotional Video
            $table->json('image_gallery')->nullable(); // JSON Array of Images
            $table->unsignedInteger('likes')->default(0); // Likes Count
            $table->unsignedInteger('views')->default(0); // Views Count
            $table->unsignedInteger('investor_commits')->default(0); // Investor Commits Count
            $table->timestamps(); // Created At, Updated At
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
