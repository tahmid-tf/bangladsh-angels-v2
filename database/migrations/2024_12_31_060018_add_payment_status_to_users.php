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
            $table->string('phone')->nullable();
            $table->string('preference_sector')->nullable();
            $table->enum('account_status',['free','core','advanced','institutional','disabled'])->default('free');
            $table->enum('payment_status',['free','due','paid'])->default('free');
            $table->enum('role', ['admin', 'investor', 'seeker', 'disabled'])->default('investor')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('preference_sector');
            $table->dropColumn('account_status');
            $table->dropColumn('payment_status');
            $table->enum('role', ['admin', 'investor', 'seeker'])->default('investor')->change();
        });
    }
};
