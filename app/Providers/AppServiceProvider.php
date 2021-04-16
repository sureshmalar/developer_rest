<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\DeveloperService;
use App\Service\DeveloperServiceImpl;

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
        $this->app->bind(DeveloperService::class,DeveloperServiceImpl::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
