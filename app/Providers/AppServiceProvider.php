<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Chromabits\Pagination\FoundationPresenter;
use App\Group;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::presenter(function($paginator)
        {
            return new FoundationPresenter($paginator);
        });

        Group::deleting(function ($group) {
            $group->owners()->detach();
            $group->members()->detach();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
