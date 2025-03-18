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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type',['event','webinar'])->default('event');
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('location')->nullable();
            $table->decimal('registration_fee', 8, 2)->nullable();
            $table->json('benefits')->nullable();           // Why Attend
            $table->json('event_highlights')->nullable();   // Keynotes, sessions, etc.
            $table->json('target_audience')->nullable();
            $table->text('registration_details')->nullable();
            $table->json('speakers')->nullable();           // Speaker details minus images
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
