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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Foreign key for the 'deals' table
            $table->unsignedBigInteger('deal_id');
            $table->foreign('deal_id')->references('id')->on('deals');

            // Foreign key for the 'users' table
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // Type column
            $table->enum('type', ['interested', 'invest', 'commit', 'review']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
