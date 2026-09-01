<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorInvestment extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'deal_id',
        'investor_name',
        'investor_email',
        'startup_name',
        'amount',
        'currency',
        'completed_at',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:4',
            'completed_at' => 'date',
        ];
    }

    public function investor()
    {
        return $this->belongsTo(User::class, 'investor_id');
    }

    public function startup()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function formattedAmount(): string
    {
        $decimals = fmod((float) $this->amount, 1.0) === 0.0 ? 0 : 2;

        return $this->currency.' '.number_format((float) $this->amount, $decimals);
    }
}
