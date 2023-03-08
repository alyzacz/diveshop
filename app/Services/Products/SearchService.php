<?php


namespace App\Services\Products;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Products\Contracts\SearchServiceInterface;

class SearchService implements SearchServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    public $productRepository;

    /**
     * SearchService constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get Product by name
     * @return mixed
     */
    public function list()
    {
        return $this->productRepository->listProducts();
    }

    /**
     * Get product
     * @return mixed
     */
    public function getProduct(array $attributes)
    {
        return $this->productRepository->findByAttributes($attributes);
    }

}
