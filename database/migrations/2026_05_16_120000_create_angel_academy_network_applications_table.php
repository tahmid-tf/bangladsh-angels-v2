<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('angel_academy_network_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('contact_number', 64);
            $table->string('linkedin_url', 512);
            $table->string('invested_before', 64);
            $table->string('primary_motivation', 64);
            $table->json('startup_stages');
            $table->json('sectors');
            $table->string('sectors_other', 500)->nullable();
            $table->string('cheque_size', 32);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('angel_academy_network_applications');
    }
};
