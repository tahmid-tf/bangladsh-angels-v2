<?php

use App\Http\Controllers\Admin\FounderPitchSubmissionController;
use App\Http\Controllers\Admin\ResourceHubCardController;
use App\Http\Controllers\Admin\StartupServiceController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\WhatWeDoCardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FounderPitchController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\ApprovedUserMiddleware;
use App\Models\Deal;
use App\Models\Payment;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Public Routes
 */
Route::get('/', PrimaryController::class)->name('home');

Route::redirect('/our-team', '/team', 301);

Route::redirect('/ban-investors', '/our-investors', 301);
Route::redirect('/investors', '/our-investors', 301);
Route::get('/our-investors', [PrimaryController::class, 'viewInvestors'])->name('investors');
Route::redirect('/ban-resources', '/deckvue', 301);
Route::get('/deckvue', [PrimaryController::class, 'viewResources'])->name('resources');
Route::get('/team', [PrimaryController::class, 'viewTeam'])->name('team');
Route::get('/angel-academy', [PrimaryController::class, 'viewAngelAcademy'])->name('angel-academy');
Route::get('/startups', [PrimaryController::class, 'viewStartups'])->name('startups');
Route::post('/startups/pitch', [FounderPitchController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('startups.pitch');

Route::get('/portfolio', function () {
    return redirect()->to(route('startups').'#portfolio-companies');
})->name('portfolio');
Route::get('/approval/pending', function () {
    return view('approval.pending');
})->name('approval.pending');
Route::get('/approval/success', function () {
    return view('approval.success');
})->name('approval.success');

Route::prefix('upgrade')->group(function () {
    Route::get('/', [PrimaryController::class, 'upgradePage'])->name('upgrade.page');
    Route::get('/plans', [PrimaryController::class, 'viewPlans'])->name('plans');
    Route::match(['get', 'post'], '/pay', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/fail', [CheckoutController::class, 'fail'])->name('checkout.fail');
    Route::post('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
});

Route::get('/deals', function () {
    if (! Auth::check() || auth()->user()->account_status == 'free') {
        return redirect()->route('upgrade.page');
    }

    return app(PrimaryController::class)->viewDeals();
})->middleware(['auth', 'verified', ApprovedUserMiddleware::class])->name('deals');

Route::get('/deals/invest', function () {
    if (! Auth::check() || auth()->user()->account_status == 'free') {
        return redirect()->route('upgrade.page');
    }

    return app(PrimaryController::class)->viewDeals_invest();
})->middleware(['auth', 'verified', ApprovedUserMiddleware::class])->name('deals.invest');

Route::get('/deals/commit', function () {
    if (! Auth::check() || auth()->user()->account_status == 'free') {
        return redirect()->route('upgrade.page');
    }

    return app(PrimaryController::class)->viewDeals_commit();
})->middleware(['auth', 'verified', ApprovedUserMiddleware::class])->name('deals.commit');

Route::get('/deals/review', function () {
    if (! Auth::check() || auth()->user()->account_status == 'free') {
        return redirect()->route('upgrade.page');
    }

    return app(PrimaryController::class)->viewDeals_review();
})->middleware(['auth', 'verified', ApprovedUserMiddleware::class])->name('deals.review');

/** Canonical deal profile URL (must stay below /deals/invest|commit|review) */
Route::get('/deals/{deal:slug}', [AdminController::class, 'showDeal'])->name('deal.view');

Route::get('/faq', [PrimaryController::class, 'viewFAQ'])->name('faq');
Route::get('/investor/signup', [PrimaryController::class, 'viewInvestorSignup'])->name('investor.signup');

/**
 * Dashboard Route
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Member Routes
 */
Route::post('/member/create', [AdminController::class, 'memberApply'])->name('member.apply');
Route::get('/view/{deal:id}', function (Deal $deal) {
    abort_unless(filled($deal->slug), 404);

    return redirect()->route('deal.view', $deal, 301);
})->name('deal.public.view');

// Legacy numeric URLs (/resources/1) → canonical slug URL (301)
Route::get('/resources/{legacyId}', function (string $legacyId) {
    $resource = Resource::query()->findOrFail((int) $legacyId);
    if (! filled($resource->slug)) {
        $resource->slug = Resource::makeUniqueSlug(
            Resource::slugBaseFromTitle((string) $resource->title),
            $resource->id
        );
        $resource->saveQuietly();
    }

    return redirect()->route('resource.public.view', $resource, 301);
})->whereNumber('legacyId')->name('resource.public.view.legacy');

Route::get('/resources/{resource:slug}', [ResourceController::class, 'view'])->name('resource.public.view');
/**
 * Authenticated Routes
 */
Route::middleware('auth')->group(function () {

    /**
     * Admin Dashboard Routes
     */
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', AdminController::class)->name('admin.dashboard');
        Route::get('/resources', ResourceController::class)->name('admin.resources');
        Route::get('/resources/create', [ResourceController::class, 'create'])->name('resource.create');
        Route::post('/resources/create', [ResourceController::class, 'store'])->name('resource.store');

        Route::get('/resources/{resource:id}/edit', [ResourceController::class, 'edit'])->name('resource.edit');
        Route::put('/resources/{resource:id}/update', [ResourceController::class, 'update'])->name('resource.update');

        Route::post('/resources/{resource:id}/delete', [ResourceController::class, 'destroy'])->name('resource.destory');

        // Subscription Routes
        Route::prefix('subscriptions')->group(function () {
            Route::get('/', [SubscriptionController::class, 'index'])->name('admin.subscriptions');
            Route::post('/tiers', [SubscriptionController::class, 'updateTiers'])->name('admin.subscription-tiers.update');
        });

        // Member Routes
        Route::prefix('members')->group(function () {
            Route::get('/', [AdminController::class, 'viewMembers'])->name('admin.members');
            Route::get('/active', [AdminController::class, 'viewActiveMembers'])->name('admin.active.members');
            Route::get('/inactive', [AdminController::class, 'viewInactiveMembers'])->name('admin.inactive.members');
            Route::get('/pending-approval', [AdminController::class, 'viewPendingApprovalMembers'])->name('admin.pending.members');
            Route::post('/{user}/approve', [AdminController::class, 'approveUser'])->name('member.approve');

            Route::get('/add', [AdminController::class, 'addMember'])->name('member.add');
            Route::post('/add/{approval}', [AdminController::class, 'createMember'])->name('member.create');
            Route::get('/{user:id}/edit', [AdminController::class, 'editMember'])->name('member.edit');
            Route::post('/{user:id}/edit', [AdminController::class, 'updateMember'])->name('member.update');
            Route::post('/{user:id}/verify-email', [AdminController::class, 'verifyMemberEmail'])->name('member.verify-email');
            Route::get('/{user:id}/remove', [AdminController::class, 'removeMember'])->name('member.remove');
            Route::patch('/update-status/{user:id}/', [AdminController::class, 'updateAccountStatus'])->name('update.account.status');

        });

        Route::prefix('mail-list')->group(function () {
            Route::get('/', MailController::class)->name('admin.mail');
            Route::post('/send', [MailController::class, 'send'])->name('mail.send');

        });

        Route::get('/founder-pitches', [FounderPitchSubmissionController::class, 'index'])->name('admin.founder-pitches');
        Route::get('/founder-pitches/{founderPitchSubmission}/deck', [FounderPitchSubmissionController::class, 'downloadDeck'])
            ->name('admin.founder-pitches.deck');

        Route::get('/resource-hub-cards', [ResourceHubCardController::class, 'index'])->name('admin.resource-hub');
        Route::get('/resource-hub-cards/create', [ResourceHubCardController::class, 'create'])->name('admin.resource-hub.create');
        Route::post('/resource-hub-cards', [ResourceHubCardController::class, 'store'])->name('admin.resource-hub.store');
        Route::get('/resource-hub-cards/{resourceHubCard}/edit', [ResourceHubCardController::class, 'edit'])->name('admin.resource-hub.edit');
        Route::put('/resource-hub-cards/{resourceHubCard}', [ResourceHubCardController::class, 'update'])->name('admin.resource-hub.update');
        Route::delete('/resource-hub-cards/{resourceHubCard}', [ResourceHubCardController::class, 'destroy'])->name('admin.resource-hub.destroy');

        Route::get('/startup-services', [StartupServiceController::class, 'index'])->name('admin.startup-services');
        Route::get('/startup-services/create', [StartupServiceController::class, 'create'])->name('admin.startup-services.create');
        Route::post('/startup-services', [StartupServiceController::class, 'store'])->name('admin.startup-services.store');
        Route::get('/startup-services/{startupService}/edit', [StartupServiceController::class, 'edit'])->name('admin.startup-services.edit');
        Route::put('/startup-services/{startupService}', [StartupServiceController::class, 'update'])->name('admin.startup-services.update');
        Route::delete('/startup-services/{startupService}', [StartupServiceController::class, 'destroy'])->name('admin.startup-services.destroy');

        Route::get('/what-we-do-cards', [WhatWeDoCardController::class, 'index'])->name('admin.what-we-do-cards');
        Route::get('/what-we-do-cards/{whatWeDoCard}/edit', [WhatWeDoCardController::class, 'edit'])->name('admin.what-we-do-cards.edit');
        Route::put('/what-we-do-cards/{whatWeDoCard}', [WhatWeDoCardController::class, 'update'])->name('admin.what-we-do-cards.update');

        Route::get('/team-members', [TeamMemberController::class, 'index'])->name('admin.team-members');
        Route::get('/team-members/create', [TeamMemberController::class, 'create'])->name('admin.team-members.create');
        Route::post('/team-members', [TeamMemberController::class, 'store'])->name('admin.team-members.store');
        Route::get('/team-members/{teamMember}/edit', [TeamMemberController::class, 'edit'])->name('admin.team-members.edit');
        Route::put('/team-members/{teamMember}', [TeamMemberController::class, 'update'])->name('admin.team-members.update');
        Route::delete('/team-members/{teamMember}', [TeamMemberController::class, 'destroy'])->name('admin.team-members.destroy');

        // Deal Routes
        Route::prefix('deals')->group(function () {
            Route::get('/', [AdminController::class, 'viewDeals'])->name('admin.deals');
            Route::get('/edit/{deal:id}', [AdminController::class, 'editDeal'])->name('edit.deal');
            Route::post('/update/{deal:id}', [AdminController::class, 'updateDeal'])->name('update.deal');
            Route::delete('/delete/{deal:id}', [AdminController::class, 'destroyDeal'])->name('delete.deal');
            Route::get('/invest', [AdminController::class, 'viewDeals_invest'])->name('admin.deals.invest');
            Route::get('/commit', [AdminController::class, 'viewDeals_commit'])->name('admin.deals.commit');
            Route::get('/review', [AdminController::class, 'viewDeals_review'])->name('admin.deals.review');
            Route::get('/portfolio', [AdminController::class, 'viewDeals_portfolio'])->name('admin.deals.portfolio');
            Route::post('/{deal:id}/invest', [InvestmentController::class, 'invest'])->name('deal.invest');

            Route::get('/{deal:id}', function (Deal $deal) {
                abort_unless(filled($deal->slug), 404);

                return redirect()->route('deal.view', $deal, 301);
            })->name('deal.view.legacy');

            Route::get('/add/new', [AdminController::class, 'addDeal'])->name('deal.add');
            Route::post('/add', [AdminController::class, 'storeDeal'])->name('deal.store');
        });

        // Investment Controller
        Route::prefix('investments')->group(function () {
            Route::get('/', InvestmentController::class)->name('admin.investments');
        });

    });

    /**
     * User Profile Routes
     */
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Investment
    Route::prefix('investments')->group(function () {

        Route::get('/type/invest', [InvestmentController::class, 'viewInvest'])->name('investment.type.invest');
        Route::get('/type/commit', [InvestmentController::class, 'viewCommit'])->name('investment.type.commit');
        Route::get('/type/review', [InvestmentController::class, 'viewReview'])->name('investment.type.review');

        Route::get('/{deal:id}/commit', [InvestmentController::class, 'commitForm'])->name('deal.commit.form');
        Route::post('/{deal:id}/commit', [InvestmentController::class, 'commit'])->name('deal.commit');
    });
});

/**
 * Payment callback routes (AamarPay POST/GET must bypass CSRF — see bootstrap/app.php)
 */
Route::prefix('payment')->group(function () {
    Route::match(['get', 'post'], '/aamarpay/callback', [CheckoutController::class, 'aamarpayCallback'])
        ->name('payment.aamarpay.callback');
    Route::get('/complete', [CheckoutController::class, 'paymentComplete'])->name('payment.complete');
    Route::get('/failed', [CheckoutController::class, 'paymentFailed'])->name('payment.failed');
    Route::get('/error', [CheckoutController::class, 'paymentError'])->name('payment.error');
    Route::get('/status', [CheckoutController::class, 'paymentStatus'])->name('payment.status');
});

/**
 * Authentication Routes
 */
require __DIR__.'/auth.php';
