<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Deal;
use App\Models\User;
class Commit extends Model
{
    protected $fillable = [
        'deal_id',       // The ID of the related deal
        'user_id',       // The ID of the user making the commitment
        'amount',        // The amount being committed
        'deadline',      // The date by when the commitment will be fulfilled
    ];

    public function user()
    {
        return $this->belongsTo(Deal::class,'user_id');
    }
    
    public function deal()
    {
        return $this->belongsTo(Deal::class,'deal_id');
    }
}
