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
            $table->string('registered_by')->nullable();
            $table->enum('used_by',['individuai','institutional','co-members'])->nullable();
            $table->enum('level',['emerald','ruby','diamond'])->nullable();
            $table->string('renewed')->nullable();
            $table->date('last_renewed_at')->nullable();
            $table->string('account_owner')->nullable();
            $table->string('primary_contact')->nullable();
            $table->decimal('total_invested', 15, 2)->default(0.00)->nullable();
            $table->decimal('revenue_generated', 15, 2)->default(0.00)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_overseas')->default(false)->nullable();
            $table->boolean('was_referred')->default(false)->nullable();
            $table->string('referred_by')->nullable();
        
            $table->renameColumn('strategic_investment_analyst', 'secondary_contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'registered_by',
                'used_by',
                'renewed',
                'level',
                'was_referred',
                'last_renewed_at',
                'primary_contact',
                'account_owner',
                'total_invested',
                'revenue_generated',
                'notes',
                'is_overseas',
                'referred_by'
            ]);
            $table->renameColumn('secondary_contact', 'strategic_investment_analyst');
        });
    }
};
