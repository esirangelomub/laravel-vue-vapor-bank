<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('isAdmin', function ($app) {
            return auth()->user()->load(['account'])->account->account_types_id === 2 ?? false;
        });
        $this->app->singleton('getAccountId', function ($app) {
            return auth()->user()->load(['account'])->account->id ?? null;
        });
    }

}
