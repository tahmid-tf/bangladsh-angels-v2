<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add new columns
            $table->string('registered_by')->nullable();
            $table->string('used_by')->nullable();
            $table->text('level')->nullable();
            $table->string('renewed')->nullable();
            $table->string('last_renewed_at')->nullable();
            $table->string('gender')->nullable();
            $table->string('account_owner')->nullable();
            $table->string('primary_contact')->nullable();
            
            // // Use decimal for precision and scale
            $table->text('total_invested')->nullable();
            $table->text('revenue_generated')->nullable();
    
            // // Add other columns
            $table->text('notes')->nullable();
            $table->boolean('is_overseas')->default(false);
            $table->boolean('was_referred')->default(false);
            $table->string('referred_by')->nullable();
    
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
                'gender',
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
        });
    }
};
