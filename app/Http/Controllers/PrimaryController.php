<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('deals.index');
    }

    public function viewFAQ(){
        return view('faq');
    }

    public function viewAbout(){
        return view('about');
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
