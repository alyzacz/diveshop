<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Repositories\TagRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }
    

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
