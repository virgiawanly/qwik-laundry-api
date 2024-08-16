<?php

namespace App\Providers;

use App\Repositories\AddOnRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\Interfaces\AddOnRepositoryInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\OutletRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ProductTypeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\OutletRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;
use App\Repositories\UserRepository;
use App\Services\AddOnService;
use App\Services\CompanyService;
use App\Services\CustomerService;
use App\Services\OutletService;
use App\Services\ProductService;
use App\Services\ProductTypeService;
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

        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(CustomerService::class, function ($app) {
            return new CustomerService($app->make(CustomerRepositoryInterface::class));
        });

        $this->app->bind(ProductTypeRepositoryInterface::class, ProductTypeRepository::class);
        $this->app->bind(ProductTypeService::class, function ($app) {
            return new ProductTypeService($app->make(ProductTypeRepositoryInterface::class));
        });

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService($app->make(ProductRepositoryInterface::class));
        });

        $this->app->bind(AddOnRepositoryInterface::class, AddOnRepository::class);
        $this->app->bind(AddOnService::class, function ($app) {
            return new AddOnService($app->make(AddOnRepositoryInterface::class));
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
