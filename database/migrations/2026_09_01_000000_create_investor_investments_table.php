<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investor_investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deal_id')->nullable()->constrained('deals')->nullOnDelete();
            $table->string('investor_name');
            $table->string('investor_email');
            $table->string('startup_name');
            $table->decimal('amount', 20, 4);
            $table->char('currency', 3);
            $table->date('completed_at');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['investor_id', 'completed_at']);
            $table->index(['deal_id', 'completed_at']);
            $table->index(['currency', 'completed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_investments');
    }
};
