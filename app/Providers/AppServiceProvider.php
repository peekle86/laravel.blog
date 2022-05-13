<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
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
        Paginator::useBootstrap(); // activate bootstrap for pagination

        view()->composer('layouts.main', function ($view) { // add values to the sidebar menu
            if (Cache::has('menuCategories')) { // looking for menu in cache
                $menuCategories = Cache::get('menuCategories'); // and set up if exist
            } else {
                $menuCategories = Category::all(); // get menu
                Cache::put('menuCategories', $menuCategories, 1 * 60 * 60); // put to cache for 1 hour
            }
            $view->with('menuCategories', $menuCategories);
        });
    }
}
