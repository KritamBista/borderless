<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
          View::composer('*', function ($view) {

            // Company (cached per request)
            $company = Company::query()->first();

            // Auth user (null if guest)
            // $user = Auth::user();

            $view->with([
                'company' => $company,
                // 'user' => $user,
            ]);
        });
    }
}
