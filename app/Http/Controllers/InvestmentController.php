<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\User;
use App\Models\Commit;
use App\Models\Deal;

class InvestmentController extends Controller
{
    public function __invoke()
    {
        $investments = Investment::all();
        return view('admin.investments.index',compact('investments'));
    }

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
            // Exception for Review Deals
            if($deal->type=="review"){
                return redirect()->to($deal->action_link);
            }
            return back()->with('error', 'You have already invested in this deal.');
        }

        // Create a new investment record
        Investment::create([
            'deal_id' => $request->deal_id,
            'user_id' => $request->user_id,
            'type' => $deal->type, // Default type
        ]);

        if($deal->type=="invest"){
            return back()->with('success', 'Investment recorded successfully! You will receive investment details from the lead investment analyst shortly');
        } elseif($deal->type=="commit"){
            return redirect()->route('deal.commit.form',$deal->id);
        } elseif($deal->type=="review") {
            return redirect()->to($deal->action_link);
        }
        return back()->with('success', 'Investment recorded successfully!');
    }

    public function commitForm(Request $request, Deal $deal)
    {
        return view('deals.commitForm',compact('deal'));
    }

    public function commit(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'deal_id' => 'required|exists:deals,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
            'deadline' => 'required|date',
        ]);

        // Check if the user has already invested in the deal
        $existingCommit = Commit::where('user_id', $request->user_id)
        ->where('deal_id', $request->deal_id)
        ->first();

        if ($existingCommit) {
            
            return redirect()->route('deal.view',$deal->id)->with('error', 'You have already committed to this deal.');
        }

        $newCommit = Commit::create([
            'deal_id' => $deal->id,
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
            'deadline' => $request->deadline,
        ]);
        return redirect()->route('deal.view',$deal->id)->with('success', 'Commitment recorded successfully!');
    }
}
