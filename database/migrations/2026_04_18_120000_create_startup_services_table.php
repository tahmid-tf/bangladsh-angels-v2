<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startup_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('intro');
            $table->json('bullets')->nullable();
            $table->text('footer_note')->nullable();
            $table->string('link');
            $table->string('cta_label');
            $table->boolean('show_brochure_link')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startup_services');
    }
};
