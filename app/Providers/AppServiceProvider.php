<?php

namespace App\Providers;

use App\Models\Admin\Profile;
use Illuminate\Support\Facades\View;
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
        View::composer(['layouts.user.partials.header', 'layouts.admin.partials.sidebar'], function ($view) {
            $view->with('profile', Profile::all());
        });
    }
}
