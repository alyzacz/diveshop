<?php


namespace App\Services\Products;


use App\Services\Products\Contracts\ProductServiceInterface;
use App\Services\Products\Contracts\CreateServiceInterface;
use App\Services\Products\Contracts\SearchServiceInterface;
use App\Services\Products\Contracts\DeleteServiceInterface;



class ProductService implements ProductServiceInterface
{
    /**
     * @var CreateServiceInterface
     */
    public $createService;

    /**
     * @var SearchServiceInterface
     */
    public $searchService;

     /**
     * @var DeleteServiceInterface
     */
    public $deleteService;

    /**
     * ProductService constructor.
     */
    public function __construct(
        CreateServiceInterface $createService,
        SearchServiceInterface $searchService,
        DeleteServiceInterface $deleteService
    ) {
        $this->createService = $createService;
        $this->searchService = $searchService;
        $this->deleteService = $deleteService;
    }

    /**
     * Create new Product
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->createService->execute($attributes);
    }

    public function list() {
        return $this->searchService->list();
    }

    public function delete(int $id)
    {
        return $this->deleteService->execute($id);
    }

    /**
     * Get category by attributes
     * @return App\Product
     */
    public function getProduct(array $attributes)
    {
        return $this->searchService->getProduct($attributes);
    }

}
