<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $URL = request()->fullUrl();
        // if (strpos($URL, 'ooredoo_q') !== false) {
        //     $lang = 'en';
        //     session()->put('applocale', $lang);
        // }

        Schema::defaultStringLength(191);
    }
}
