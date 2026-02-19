<?php

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
