<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\User;
use App\Models\Deal;

class InvestmentController extends Controller
{
    public function invest(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'deal_id' => 'required|exists:deals,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Check if the user has already invested in the deal
        $existingInvestment = Investment::where('user_id', $request->user_id)
        ->where('deal_id', $request->deal_id)
        ->first();

        if ($existingInvestment) {
            return back()->with('error', 'You have already invested in this deal.');
        }

        // Create a new investment record
        Investment::create([
            'deal_id' => $request->deal_id,
            'user_id' => $request->user_id,
            'type' => $deal->type, // Default type
        ]);

        return back()->with('success', 'Investment recorded successfully!');
    }
}
