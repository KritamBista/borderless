<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        //
        Filament::serving(function () {
            $user = Auth::user();

            // dd($user);

            // if ($user && $user->role === 'customer') {

            //     abort(403, "Access denied");
            // }
        });
    }
}
