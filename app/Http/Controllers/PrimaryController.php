<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Deal;
use App\Models\User;

class PrimaryController extends Controller
{
    public function __invoke()
    {
        $portfolioDeals = Deal::where('type','portfolio')->take(3)->get();
        $deals = Deal::take(3)->get();
        return view('welcome',compact('portfolioDeals','deals'));
    }

    public function upgradePage(){
        return view('upgrade');
    }

    public function viewPortfolio()
    {
        $deals = Deal::with('media')->where('type','portfolio')->get();
        return view('portfolio',compact('deals'));
    }

    public function viewPlans()
    {
        return view('plans');
    }

    public function viewCheckout()
    {
        return view('payment.checkout');
    }

    public function viewDeals()
    {
        //Get All Deals except Portfolio and Draft
        $deals = Deal::with('media')
        ->where(function ($query) {
            $query->where('type', '!=', 'portfolio')
                  ->where('status', '!=', 'closed')
                  ->where('status', '!=', 'draft');
        })
        ->get();
        return view('deals.index', compact('deals'));
    }

    public function viewDeals_invest()
    {
        $deals = Deal::with('media')->where(function ($query) {
            $query->where('type','invest')
                  ->where('status', '!=', 'closed')
                  ->where('status', '!=', 'draft');
        })
        ->get();
        return view('deals.invest', compact('deals'));
    }

    public function viewDeals_commit()
    {
        $deals = Deal::with('media')
        ->where(function ($query) {
            $query->where('type','commit')
                  ->where('status', '!=', 'closed')
                  ->where('status', '!=', 'draft');
        })
        ->get();
        return view('deals.commit', compact('deals'));
    }

    public function viewDeals_review()
    {
        $deals = Deal::with('media')
        ->where(function ($query) {
            $query->where('type','review')
                  ->where('status', '!=', 'closed')
                  ->where('status', '!=', 'draft');
        })
        ->get();
        return view('deals.review', compact('deals'));
    }

    public function viewFAQ(){
        return view('faq');
    }

    public function viewTeam(){
        return view('team');
    }

    public function viewInvestorSignup()
    {
        return view('investor.signup');
    }

    public function viewInvestors()
    {
        if (!Auth::check()) {
            return redirect()->route('upgrade.page');
        }
        $investors = User::where('public_profile','true')->get();
        return view('investors',compact('investors'));
    }

    public function viewResources()
    {
        return view('resources');
    }

    public function checkout(Request $request)
    {
        dd($request);
    }
}
