<?php

namespace App\Providers;

use App\View\Composers\AppComposer;
use Illuminate\Support\ServiceProvider;
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
    public function boot(): void
    {
        //
        View::composer('layouts.app', AppComposer::class);
        View::composer('admin.admin_dashboard', AppComposer::class);

    }
}
