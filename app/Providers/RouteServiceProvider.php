<?php

namespace App\Providers;

use App\Services\HashIdService;
use Exception;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(HashIdService::class, fn($app) => HashIdService::getInstance());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::bind('hash_id', function ($hashId) {
            try {
                return HashIdService::decode($hashId);
            } catch (Exception $e) {
                abort(404, 'No item found with this hash_id!');
            }
        });
    }
}
