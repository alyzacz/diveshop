<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Products\ProductService;
use App\Services\Products\CreateService as ProductCreateService;
use App\Services\Products\SearchService as ProductSearchService;
use App\Services\Products\DeleteService as ProductDeleteService;
use App\Services\Tags\TagService;
use App\Services\Tags\CreateService as TagCreateService;
use App\Services\Tags\SearchService as TagSearchService;
use App\Services\Tags\DeleteService as TagDeleteService;
use App\Services\Products\Contracts\ProductServiceInterface;
use App\Services\Products\Contracts\CreateServiceInterface as ProductCreateServiceInterface;
use App\Services\Products\Contracts\SearchServiceInterface as ProductSearchServiceInterface;
use App\Services\Products\Contracts\DeleteServiceInterface as ProductDeleteServiceInterface;
use App\Services\Tags\Contracts\TagServiceInterface;
use App\Services\Tags\Contracts\CreateServiceInterface as TagCreateServiceInterface;
use App\Services\Tags\Contracts\SearchServiceInterface as TagSearchServiceInterface;
use App\Services\Tags\Contracts\DeleteServiceInterface as TagDeleteServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ProductCreateServiceInterface::class,  ProductCreateService::class);
        $this->app->bind(ProductSearchServiceInterface::class,  ProductSearchService::class);
        $this->app->bind(ProductDeleteServiceInterface::class,  ProductDeleteService::class);

        $this->app->bind(TagServiceInterface::class,    TagService::class);
        $this->app->bind(TagCreateServiceInterface::class, TagCreateService::class);
        $this->app->bind(TagSearchServiceInterface::class, TagSearchService::class);
        $this->app->bind(TagDeleteServiceInterface::class, TagDeleteService::class);
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
