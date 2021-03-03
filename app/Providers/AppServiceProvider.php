<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\ItemClassRepository;
use App\Repository\ItemRepository;

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
        $this->app->bind(ItemRepository::class, ItemClassRepository::class);
    }
}
