<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Resource;
use App\Models\ResourceHubCard;
use App\Models\StartupService;
use App\Models\SubscriptionTier;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\WhatWeDoCard;
use Illuminate\Http\Request;

class PrimaryController extends Controller
{
    // Landing Page
    public function __invoke()
    {
        // if(!auth()->user() || !auth()->user()->isAdmin() ){
        //     return view('soon');
        // }

        $whatWeDoCards = WhatWeDoCard::query()
            ->with('media')
            ->ordered()
            ->get();

        $landingResourceEvents = Resource::query()
            ->with('media')
            ->where('type', 'event')
            ->where('show_on_landing', true)
            ->orderByRaw('CASE WHEN date IS NULL THEN 1 ELSE 0 END')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        return view('welcome', compact('whatWeDoCards', 'landingResourceEvents'));
    }

    // Upgrade Page
    public function upgradePage()
    {
        return view('upgrade');
    }

    // Startups hub: active deals (paywalled in the view), pitch, services, portfolio (public)
    public function viewStartups()
    {
        $portfolioDeals = Deal::with('media')->where('type', 'portfolio')->get();
        $activeDeals = Deal::with('media')
            ->where('type', '!=', 'portfolio')
            ->where('status', 'active')
            ->get();

        $canViewActiveDeals = auth()->check() && auth()->user()->canViewPaywalledDeals();

        $startupServices = StartupService::query()->with('media')->ordered()->get();

        return view('startups', compact('portfolioDeals', 'activeDeals', 'canViewActiveDeals', 'startupServices'));
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
        $management = TeamMember::query()
            ->forSection(TeamMember::SECTION_MANAGEMENT)
            ->ordered()
            ->get();

        $governingBoard = TeamMember::query()
            ->forSection(TeamMember::SECTION_GOVERNING_BOARD)
            ->ordered()
            ->get();

        return view('team', compact('management', 'governingBoard'));
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

        $showMembershipPlans = ! auth()->check() || auth()->user()->isFree();

        $tiers = $showMembershipPlans
            ? SubscriptionTier::query()->active()->ordered()->get()
            : collect();

        return view('investors', compact('investors', 'tiers', 'showMembershipPlans'));
    }

    // View Resources Page (hub cards; content managed in admin)
    public function viewResources()
    {
        if (! auth()->check()) {
            return redirect()->route('upgrade.page');
        }

        $user = auth()->user();
        if (! $user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        if (! $user->is_approved) {
            return redirect()->route('approval.pending');
        }

        $hubCards = ResourceHubCard::query()->ordered()->get();

        $resourceEvents = Resource::query()
            ->with('media')
            ->whereIn('type', ['event', 'webinar'])
            ->orderByRaw('CASE WHEN date IS NULL THEN 1 ELSE 0 END')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->get();

        return view('resources', compact('hubCards', 'resourceEvents'));
    }

    public function checkout(Request $request)
    {
        dd($request);
    }
}
