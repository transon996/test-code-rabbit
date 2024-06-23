<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->loadApplicationHelpers();
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

    /**
     * This function will load all helpers of this application
     *
     * @return void
     */
    protected function loadApplicationHelpers(): void
    {
        $helpers = File::glob(__DIR__ . '/../Utils/*.php');

        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }
}
