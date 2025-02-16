<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\ProjectService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Di daftarkan ke Service Container
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });

        $this->app->bind(ProjectService::class, function ($app) {
            return new ProjectService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
