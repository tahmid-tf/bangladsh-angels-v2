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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            // Foreign key for the 'users' table
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('plan');
            $table->decimal('price', 8, 2); // Plan price
            $table->enum('status', ['active', 'pending', 'cancelled'])->default('pending'); // Subscription status
            $table->timestamp('start_date')->nullable(); // Start date of the subscription
            $table->timestamp('end_date')->nullable(); // End date of the subscription
            $table->timestamps(); // Created at & Updated at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
