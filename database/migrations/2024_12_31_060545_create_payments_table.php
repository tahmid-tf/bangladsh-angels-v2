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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Correctly define as unsignedBigInteger
            $table->string('payment_method'); // e.g., Stripe, PayPal, etc.
            $table->string('transaction_id')->nullable(); // Transaction reference
            $table->string('subscription_plan'); // Name of the subscription plan
            $table->decimal('amount', 10, 2); // Payment amount
            $table->string('currency')->default('USD'); // Currency used
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Payment status
            $table->timestamp('payment_date')->nullable(); // Date of payment
            $table->timestamp('expiry_date')->nullable(); // Expiry date for the subscription
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
