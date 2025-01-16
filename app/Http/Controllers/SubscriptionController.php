<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function __invoke()
    {
        $subscriptions = Subscription::with('user')->get();
        return view('admin.subscriptions.index',compact('subscriptions'));
    }
}
