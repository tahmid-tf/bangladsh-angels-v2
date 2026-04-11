<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Resource;
use App\Models\SubscriptionTier;
use App\Models\User;
use Illuminate\Http\Request;

class PrimaryController extends Controller
{
    // Landing Page
    public function __invoke()
    {
        // if(!auth()->user() || !auth()->user()->isAdmin() ){
        //     return view('soon');
        // }

        return view('welcome');
    }

    // Upgrade Page
    public function upgradePage()
    {
        return view('upgrade');
    }

    // Startups hub: portfolio (public) + active deals (paywalled in the view) + pitch + services
    public function viewStartups()
    {
        $portfolioDeals = Deal::with('media')->where('type', 'portfolio')->get();
        $activeDeals = Deal::with('media')
            ->where('type', '!=', 'portfolio')
            ->where('status', 'active')
            ->get();

        $canViewActiveDeals = auth()->check() && auth()->user()->canViewPaywalledDeals();

        return view('startups', compact('portfolioDeals', 'activeDeals', 'canViewActiveDeals'));
    }

    // Subscription Plans Page
    public function viewPlans()
    {
        $tiers = SubscriptionTier::query()->active()->ordered()->get();

        return view('plans', compact('tiers'));
    }

    // Checkout Page
    public function viewCheckout()
    {
        return view('payment.checkout');
    }

    // View Deals Page
    public function viewDeals()
    {
        // Show only active non-portfolio deals on /deals
        $deals = Deal::with('media')
            ->where('type', '!=', 'portfolio')
            ->where('status', 'active')
            ->get();

        return view('deals.index', compact('deals'));
    }

    // View Deals Page - Invest Category
    public function viewDeals_invest()
    {
        $deals = Deal::with('media')->where(function ($query) {
            $query->where('type', 'invest')
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
                $query->where('type', 'commit')
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
                $query->where('type', 'review')
                    ->where('status', '!=', 'closed')
                    ->where('status', '!=', 'draft');
            })
            ->get();

        return view('deals.review', compact('deals'));
    }

    // View FAQ Page
    public function viewFAQ()
    {
        return view('faq');
    }

    // View Team Page
    public function viewTeam()
    {
        return view('team');
    }

    // View Sign up Page
    public function viewInvestorSignup()
    {
        return view('investor.signup');
    }

    // View Investors Page (public; curated featured members)
    public function viewInvestors()
    {
        $investors = User::query()
            ->where('featured', true)
            ->where('is_approved', true)
            ->orderBy('name')
            ->get();

        return view('investors', compact('investors'));
    }

    // View Resources Page
    public function viewResources()
    {
        $events = Resource::where('type', 'event')->latest()->get();
        $webinars = Resource::where('type', 'webinar')->latest()->get();

        return view('resources', compact('events', 'webinars'));
    }

    public function checkout(Request $request)
    {
        dd($request);
    }
}
