<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\QuoteEstimator;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Home::class);
Route::get('/request-order', QuoteEstimator::class)->name('calculator');
Route::get('/checkout/{public_id}', \App\Livewire\Frontend\Checkout::class)
    ->middleware('auth')
    ->name('checkout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Livewire\Frontend\DashboardShell::class)->name('user.dashboard');
    Route::get('/dashboard/orders', \App\Livewire\Frontend\MyOrders::class)->name('user.orders');
    Route::get('/dashboard/profile', \App\Livewire\Frontend\MyProfile::class)->name('user.profile');


Route::get('/dashboard/orders/{order}', \App\Livewire\Frontend\OrderDetails::class)
    ->middleware('auth')
    ->name('user.order.details');


Route::get('/dashboard/profile', \App\Livewire\Frontend\MyProfile::class)
    ->middleware('auth')
    ->name('user.profile');
    Route::get('/logout/confirm', [LogoutController::class, 'confirm'])
        ->name('logout.confirm');

    Route::post('/logout', [LogoutController::class, 'logout'])
        ->name('logout.perform');

});


Route::get('/logout-success', [LogoutController::class, 'success'])
    ->name('logout.success');
