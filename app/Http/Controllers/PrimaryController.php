<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimaryController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
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
}
