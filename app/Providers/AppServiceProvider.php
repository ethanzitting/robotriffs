<?php

namespace App\Providers;

use App\Mixins\TestResponseMacros;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;

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
        TestResponse::mixin(new TestResponseMacros());
    }
}
