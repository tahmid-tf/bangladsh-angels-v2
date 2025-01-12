<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Deal;

class Investment extends Model
{
    protected $fillable = [
        'deal_id',
        'user_id',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }
}
