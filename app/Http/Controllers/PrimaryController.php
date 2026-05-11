<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Resource;
use App\Models\StartupService;
use App\Models\SubscriptionTier;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\WhatWeDoCard;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

        $whatWeDoCards = $this->orderWhatWeDoCardsForLanding($whatWeDoCards);

        // Same pool as /deckvue BAN Events (event + webinar); homepage shows the six most recent, with "featured" first.
        $landingResourceEvents = Resource::query()
            ->with('media')
            ->whereIn('type', ['event', 'webinar'])
            ->orderByDesc('show_on_landing')
            ->orderByRaw('CASE WHEN date IS NULL THEN 1 ELSE 0 END')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        return view('welcome', compact('whatWeDoCards', 'landingResourceEvents'));
    }

    /**
     * On the landing “What We Do” grid (three cards), place Showcases in the center column.
     */
    private function orderWhatWeDoCardsForLanding(Collection $cards): Collection
    {
        $showcases = $cards->firstWhere('slug', WhatWeDoCard::SLUG_SHOWCASES);
        $others = $cards->where('slug', '!=', WhatWeDoCard::SLUG_SHOWCASES)->values();

        if ($showcases !== null && $others->count() === 2) {
            return collect([$others[0], $showcases, $others[1]]);
        }

        return $cards;
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
        $showFreeTierOption = auth()->check()
            && auth()->user()->hasVerifiedEmail()
            && auth()->user()->account_status === 'free';

        return view('plans', compact('tiers', 'showFreeTierOption'));
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

    /** Public marketing page for the BAN Angel Academy programme. */
    public function viewAngelAcademy()
    {
        return view('angel-academy');
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
        $tiers = SubscriptionTier::query()->active()->ordered()->get();

        return view('investor.signup', compact('tiers'));
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

    // View Resources Page (public DeckVue marketing page at /deckvue)
    public function viewResources()
    {
        return view('resources');
    }

    public function checkout(Request $request)
    {
        dd($request);
    }
}
