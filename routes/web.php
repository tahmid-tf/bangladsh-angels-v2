<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\SubscriberCheckMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', PrimaryController::class)->name('home');
Route::get('/upgrade',[PrimaryController::class,'upgradePage'])->name('upgrade.page');
Route::get('/upgrade/plans',[PrimaryController::class,'viewPlans'])->name('plans');
Route::get('/upgrade/pay',[PrimaryController::class,'viewCheckout'])->name('checkout');

Route::get('/deals', function () {
    if (!Auth::check()) {
        return redirect()->route('upgrade.page'); // Redirect to the plans page if not authenticated
    }

    // Call the controller's `viewDeals` method
    return app(PrimaryController::class)->viewDeals();
})->name('deals');
Route::get('/faq', [PrimaryController::class,'viewFAQ'])->name('faq');
Route::get('/about', [PrimaryController::class,'viewAbout'])->name('about');
Route::get('/investor/signup', [PrimaryController::class,'viewInvestorSignup'])->name('investor.signup');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/member/create', [AdminController::class,'memberApply'])->name('member.apply');

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', AdminController::class)->name('admin.dashboard');
    Route::get('/admin/members', [AdminController::class,'viewMembers'])->name('admin.members');
    Route::get('/admin/member/add', [AdminController::class,'addMember'])->name('member.add');
    Route::post('/admin/member/add/{approval}', [AdminController::class,'createMember'])->name('member.create');

    Route::get('/admin/deals', [AdminController::class,'viewDeals'])->name('admin.deals');
    Route::get('/admin/deal/add', [AdminController::class,'addDeal'])->name('deal.add');


    Route::get('deal/1', [AdminController::class,'viewDeal'])->name('deal.view');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
