<?php

namespace App\Providers;

use App\Repositories\AddressRepositoryInterface;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\Eloquent\AddressRepository;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\OrderProductRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\OrderProductRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(OrderProductRepositoryInterface::class, OrderProductRepository::class);
    }
}
