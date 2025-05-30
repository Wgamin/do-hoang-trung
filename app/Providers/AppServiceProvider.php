<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Phone;
use Illuminate\Support\Facades\View;

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
    public function boot()
    {
        View::composer('partials.navigation', function ($view) {
            $view->with('phones', Phone::where('is_active', true)->get());
        });
    }
}
