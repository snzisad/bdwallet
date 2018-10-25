<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\OnlineStatus;
use App\Gateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        view()->composer("layouts.generalLayout", function ($layout) {
            $layout->with("admin_status", OnlineStatus::where('user_id', 1)->first());
        });
        view()->composer("layouts.generalLayout", function ($layout) {
            $layout->with("all_gateway", Gateway::orderBy("name", "asc")->get());
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
