<?php


namespace App\Repositories\Contracts;


interface ProductRepositoryInterface extends RepositoryInterface
{
    public function listProducts();
    public function createProduct(array $attributes);
    public function deleteProduct(int $id);
}
