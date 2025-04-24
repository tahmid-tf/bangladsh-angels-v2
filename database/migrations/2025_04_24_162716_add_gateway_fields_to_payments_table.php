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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('merchant_txnid', 255)->nullable()->index();
            $table->string('pg_txnid', 255)->nullable()->unique();
            $table->unsignedTinyInteger('status_code')->nullable();
            $table->string('risk_title', 50)->nullable();
            $table->unsignedTinyInteger('risk_level')->nullable();
            $table->decimal('gateway_fee', 12, 2)->nullable()->comment('processing_charge');
            $table->decimal('gateway_fee_pct', 5, 2)->nullable()->comment('processing_ratio');
            $table->decimal('net_amount', 12, 2)->nullable()->comment('store_amount');
            $table->decimal('fx_rate', 12, 6)->nullable()->comment('conversion_rate');
            $table->decimal('foreign_amount', 12, 2)->nullable()->comment('amount_currency');
            $table->string('bank_trxid', 30)->nullable();
            $table->string('approval_code', 30)->nullable();
            $table->enum('verify_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('customer_ip', 45)->nullable()->comment('IPv4 or IPv6');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'merchant_txnid',
                'pg_txnid',
                'status_code',
                'risk_title',
                'risk_level',
                'gateway_fee',
                'gateway_fee_pct',
                'net_amount',
                'fx_rate',
                'foreign_amount',
                'bank_trxid',
                'approval_code',
                'verify_status',
                'customer_ip',
            ]);
        });
    }
};
