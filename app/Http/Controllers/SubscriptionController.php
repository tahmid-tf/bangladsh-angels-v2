<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Payment;

class SubscriptionController extends Controller
{
    public function __invoke()
    {
        // Get subscriptions with their related users and payments
        $subscriptions = Subscription::with(['user', 'payment'])
            ->whereHas('user', function ($query) {
                $query->where('account_status', '!=', 'free');
            })
            ->get();
        
        // Get users with non-free accounts that don't have any subscription record
        $usersWithoutSubscriptions = User::where('account_status', '!=', 'free')
            ->whereNotIn('id', $subscriptions->pluck('user_id'))
            ->get();
            
        return view('admin.subscriptions.index', compact('subscriptions', 'usersWithoutSubscriptions'));
    }
}
