<?php

namespace App\Providers;

use App\Services\QrCodeService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(QrCodeService::class, function ($app) {
            return QrCodeService::getInstance();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }
}
