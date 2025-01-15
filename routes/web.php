<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvestmentController;
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
Route::get('/ban-investors',[PrimaryController::class,'viewInvestors'])->name('investors');
Route::get('/resources',[PrimaryController::class,'viewResources'])->name('resources');
Route::get('/portfolio',[PrimaryController::class,'viewPortfolio'])->name('portfolio');

Route::prefix('upgrade')->group(function () {
    Route::get('/', [PrimaryController::class, 'upgradePage'])->name('upgrade.page');
    Route::get('/plans', [PrimaryController::class, 'viewPlans'])->name('plans');
    Route::match(['get', 'post'], '/pay', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/success',[CheckoutController::class,'success'])->name('checkout.success');
});

Route::get('/deals', function () {
    if (!Auth::check() || auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewDeals();
})->name('deals');

Route::get('/deals/invest', function () {
    if (!Auth::check() || auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewDeals_invest();
})->name('deals.invest');

Route::get('/deals/commit', function () {
    if (!Auth::check() || auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewDeals_commit();
})->name('deals.commit');

Route::get('/deals/review', function () {
    if (!Auth::check() || auth()->user()->account_status == "free") {
        return redirect()->route('upgrade.page');
    }
    return app(PrimaryController::class)->viewDeals_review();
})->name('deals.review');

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

/**
 * Authenticated Routes
 */
Route::middleware('auth')->group(function () {

    /**
     * Admin Dashboard Routes
     */
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', AdminController::class)->name('admin.dashboard');
        
        // Member Routes
        Route::prefix('members')->group(function () {
            Route::get('/', [AdminController::class, 'viewMembers'])->name('admin.members');
            Route::get('/add', [AdminController::class, 'addMember'])->name('member.add');
            Route::post('/add/{approval}', [AdminController::class, 'createMember'])->name('member.create');
            Route::get('/{user:id}/edit', [AdminController::class, 'editMember'])->name('member.edit');
            Route::post('/{user:id}/edit', [AdminController::class, 'updateMember'])->name('member.update');
            Route::get('/{user:id}/remove', [AdminController::class, 'removeMember'])->name('member.remove');
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
            Route::post('/{deal:id}/invest', [InvestmentController::class, 'invest'])->name('deal.invest');

            Route::get('/{deal:id}',[AdminController::class,'showDeal'])->name('deal.view');
            Route::get('/add/new', [AdminController::class, 'addDeal'])->name('deal.add');
            Route::post('/add', [AdminController::class, 'storeDeal'])->name('deal.store');
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
});

/**
 * Authentication Routes
 */
require __DIR__.'/auth.php';
