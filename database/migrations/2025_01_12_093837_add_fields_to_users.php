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
            // $table->enum('gender',['male','female','other']);
            // $table->string('linkedin')->nullable();
            $table->string('expertise_level')->nullable();
            $table->string('strategic_investment_analyst')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('linkedin');
            $table->dropColumn('expertise_level');
            $table->dropColumn('strategic_investment_analyst');
        });
    }
};
