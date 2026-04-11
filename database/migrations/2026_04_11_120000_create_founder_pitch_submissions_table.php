<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('founder_pitch_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('contact_email');
            $table->string('one_line', 500);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('founder_pitch_submissions');
    }
};
