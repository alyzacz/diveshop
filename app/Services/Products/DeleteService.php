<?php


namespace App\Services\Products;


use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Products\Contracts\DeleteServiceInterface;

class DeleteService implements DeleteServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    public $productRepository;

    /**
     * DeleteService constructor.
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
    public function execute(int $id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}
