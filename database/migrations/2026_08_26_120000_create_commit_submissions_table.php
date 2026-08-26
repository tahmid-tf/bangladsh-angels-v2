<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commit_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deal_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp_number', 50);
            $table->string('company_name');
            $table->decimal('amount', 15, 2);
            $table->char('currency', 3);
            $table->timestamps();

            $table->unique(['deal_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commit_submissions');
    }
};
