<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;

class Subscription extends Model
{
    protected $fillable =[
        'user_id',
        'plan',
        'price',
        'status',
        'payment_id',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function __invoke()
    {
        //
    }
}
