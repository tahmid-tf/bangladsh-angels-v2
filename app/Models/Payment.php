<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'transaction_id',
        'subscription_plan',
        'amount',
        'currency',
        'status',
        'payment_date',
        'expiry_date',
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
    ];

    protected $casts = [
        'status_code' => 'integer',
        'risk_level' => 'integer',
        'gateway_fee_pct' => 'float',
        'fx_rate' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
