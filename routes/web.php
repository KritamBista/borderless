<?php

use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\QuoteEstimator;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Home::class);
Route::get('/request-order', QuoteEstimator::class)->name('calculator');
