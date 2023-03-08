<?php


namespace App\Services\Products;


use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Products\Contracts\CreateServiceInterface;

class CreateService implements CreateServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    public $productRepository;

    /**
     * CreateService constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function execute(array $attributes)
    {
        return $this->productRepository->createProduct($attributes);
    }
}
