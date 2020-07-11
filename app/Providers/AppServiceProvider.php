<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

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
        Builder::macro('whereLike', function($attributes, string $searchTerm) {
          $this->where(function($q) use ($attributes,$searchTerm){
            foreach($attributes as $attribute) {
              $q->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
            }
          });
          return $this;
        });
    }
}
