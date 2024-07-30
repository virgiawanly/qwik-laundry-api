<?php

namespace App\Providers;

use App\Repositories\CompanyRepository;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\OutletRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\OutletRepository;
use App\Repositories\UserRepository;
use App\Services\CompanyService;
use App\Services\OutletService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(CompanyService::class, function ($app) {
            return new CompanyService($app->make(CompanyRepositoryInterface::class));
        });

        $this->app->bind(OutletRepositoryInterface::class, OutletRepository::class);
        $this->app->bind(OutletService::class, function ($app) {
            return new OutletService($app->make(OutletRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
