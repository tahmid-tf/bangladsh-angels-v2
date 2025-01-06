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
            $table->string('pitch_deck_url')->nullable(); // URL to Pitch Deck
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // User who created the deal
            $table->enum('status', ['active', 'closed', 'draft'])->default('draft'); // Deal Status
            $table->string('slug')->unique(); // Unique Slug for URLs
            $table->string('growth_rate')->nullable(); // Growth Rate
            $table->text('revenue_model')->nullable(); // Revenue Model
            $table->text('future_plans')->nullable(); // Future Plans
            $table->text('partnerships')->nullable(); // Partnerships/Collaborations
            $table->string('video_url')->nullable(); // URL to Promotional Video
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
