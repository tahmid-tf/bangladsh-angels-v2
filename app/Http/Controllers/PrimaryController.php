<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Deal;
use App\Models\User;

class PrimaryController extends Controller
{
    // Landing Page
    public function __invoke()
    {
        if(!auth()->user() || !auth()->user()->isAdmin() ){
            return view('soon');
        }
        
        $portfolioDeals = Deal::where('type','portfolio')->take(3)->get();
        $deals = Deal::take(3)->get();
        return view('welcome',compact('portfolioDeals','deals'));
    }

    // Upgrade Page
    public function upgradePage(){
        return view('upgrade');
    }

    // Portfolio Page
    public function viewPortfolio()
    {
        $deals = Deal::with('media')->where('type','portfolio')->get();
        return view('portfolio',compact('deals'));
    }

    // Subscription Plans Page
    public function viewPlans()
    {
        return view('plans');
    }

    // Checkout Page
    public function viewCheckout()
    {
        return view('payment.checkout');
    }

    // View Deals Page
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

    // View Deals Page - Invest Category
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

    // View Deals Page - Commit Category
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

    // View Deals Page - Review Category
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

    // View FAQ Page 
    public function viewFAQ(){
        return view('faq');
    }

    // View Team Page 
    public function viewTeam(){
        return view('team');
    }

    // View Sign up Page 
    public function viewInvestorSignup()
    {
        return view('investor.signup');
    }

    // View Investors Page 
    public function viewInvestors()
    {
        if (!Auth::check()) {
            return redirect()->route('upgrade.page');
        }

        if (auth()->user()->isFree()) {
            return redirect()->route('upgrade.page');
        }

        $investors = User::where('public_profile','true')->get();
        return view('investors',compact('investors'));
    }

    // View Resources Page 
    public function viewResources()
    {
        return view('resources');
    }

    public function checkout(Request $request)
    {
        dd($request);
    }
}
