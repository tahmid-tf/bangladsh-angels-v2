<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deal;

class PrimaryController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }

    public function upgradePage(){
        return view('upgrade');
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
        $deals = Deal::all();
        return view('deals.index', compact('deals'));
    }

    public function viewDeals_invest()
    {
        $deals = Deal::where('type','invest')->get();
        return view('deals.invest', compact('deals'));
    }

    public function viewDeals_commit()
    {
        $deals = Deal::where('type','commit')->get();
        return view('deals.commit', compact('deals'));
    }

    public function viewDeals_review()
    {
        $deals = Deal::where('type','review')->get();
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
        return view('investors');
    }

    public function viewResources()
    {
        return view('resources');
    }
}
