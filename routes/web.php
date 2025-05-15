<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Deal;
use App\Models\Payment;

/**
 * Public Routes
 */
Route::get('/', PrimaryController::class)->name('home');

// New investor route
Route::get('/investors', function () {
    if (!Auth::check()) {
        return redirect()->route('upgrade.page');
    }
    if (auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewInvestors();
})->middleware(['verified', \App\Http\Middleware\ApprovedUserMiddleware::class])->name('investors');

// New resources route
Route::get('/resources', function () {
    if (!Auth::check()) {
        return redirect()->route('upgrade.page');
    }
    if (auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewResources();
})->middleware(['verified', \App\Http\Middleware\ApprovedUserMiddleware::class])->name('resources');

// Legacy routes (keeping for backward compatibility)
Route::get('/ban-investors',[PrimaryController::class,'viewInvestors'])->middleware(['auth', 'verified', \App\Http\Middleware\ApprovedUserMiddleware::class])->name('ban.investors');
Route::get('/ban-resources',[PrimaryController::class,'viewResources'])->middleware(['auth', 'verified', \App\Http\Middleware\ApprovedUserMiddleware::class])->name('ban.resources');

Route::get('/portfolio',[PrimaryController::class,'viewPortfolio'])->name('portfolio');
Route::get('/approval/pending', function() {
    return view('approval.pending');
})->name('approval.pending');
Route::get('/approval/success', function() {
    return view('approval.success');
})->name('approval.success');

Route::prefix('upgrade')->group(function () {
    Route::get('/', [PrimaryController::class, 'upgradePage'])->name('upgrade.page');
    Route::get('/plans', [PrimaryController::class, 'viewPlans'])->name('plans');
    Route::match(['get', 'post'], '/pay', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/success',[CheckoutController::class,'success'])->name('checkout.success');
    Route::post('/fail',[CheckoutController::class,'fail'])->name('checkout.fail');
    Route::post('/cancel',[CheckoutController::class,'cancel'])->name('checkout.cancel');
});

Route::get('/deals', function () {
    if (!Auth::check() || auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewDeals();
})->middleware(['auth', 'verified', \App\Http\Middleware\ApprovedUserMiddleware::class])->name('deals');

Route::get('/deals/invest', function () {
    if (!Auth::check() || auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewDeals_invest();
})->middleware(['auth', 'verified', \App\Http\Middleware\ApprovedUserMiddleware::class])->name('deals.invest');

Route::get('/deals/commit', function () {
    if (!Auth::check() || auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewDeals_commit();
})->middleware(['auth', 'verified', \App\Http\Middleware\ApprovedUserMiddleware::class])->name('deals.commit');

Route::get('/deals/review', function () {
    if (!Auth::check() || auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewDeals_review();
})->middleware(['auth', 'verified', \App\Http\Middleware\ApprovedUserMiddleware::class])->name('deals.review');

Route::get('/faq', [PrimaryController::class, 'viewFAQ'])->name('faq');
Route::get('/our-team', [PrimaryController::class, 'viewTeam'])->name('team');
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
Route::get('/view/{deal:id}',[AdminController::class,'showDeal'])->name('deal.public.view');
Route::get('/resources/{resource:id}',[ResourceController::class,'view'])->name('resource.public.view');
/**
 * Authenticated Routes
 */
Route::middleware('auth')->group(function () {


    /**
     * Admin Dashboard Routes
     */
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', AdminController::class)->name('admin.dashboard');
        Route::get('/resources',ResourceController::class)->name('admin.resources');
        Route::get('/resources/create',[ResourceController::class,'create'])->name('resource.create');
        Route::post('/resources/create',[ResourceController::class,'store'])->name('resource.store');

        Route::get('/resources/{resource:id}/edit',[ResourceController::class,'edit'])->name('resource.edit');
        Route::put('/resources/{resource:id}/update',[ResourceController::class,'update'])->name('resource.update');

        Route::post('/resources/{resource:id}/delete',[ResourceController::class,'destroy'])->name('resource.destory');

        
        // Subscription Routes
        Route::prefix('subscriptions')->group(function () {
            Route::get('/', SubscriptionController::class)->name('admin.subscriptions');

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
            Route::get('/{user:id}/remove', [AdminController::class, 'removeMember'])->name('member.remove');
            Route::patch('/update-status/{user:id}/', [AdminController::class, 'updateAccountStatus'])->name('update.account.status');

        });

        Route::prefix('mail-list')->group(function(){
            Route::get('/', MailController::class)->name('admin.mail');
            Route::post('/send', [MailController::class, 'send'])->name('mail.send');
            
        });

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

            Route::get('/{deal:id}',[AdminController::class,'showDeal'])->name('deal.view');
            Route::get('/add/new', [AdminController::class, 'addDeal'])->name('deal.add');
            Route::post('/add', [AdminController::class, 'storeDeal'])->name('deal.store');
        });

       
        // Investment Controller
        Route::prefix('investments')->group(function(){
            Route::get('/',InvestmentController::class)->name('admin.investments');
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
 * Payment Callback Routes
 */
Route::prefix('payment')->group(function () {
    Route::get('/complete', [CheckoutController::class, 'paymentComplete'])->name('payment.complete');
    Route::get('/failed', [CheckoutController::class, 'paymentFailed'])->name('payment.failed');
    Route::get('/error', [CheckoutController::class, 'paymentError'])->name('payment.error');
    Route::get('/status', [CheckoutController::class, 'paymentStatus'])->name('payment.status');
});

/**
 * Authentication Routes
 */
require __DIR__.'/auth.php';
