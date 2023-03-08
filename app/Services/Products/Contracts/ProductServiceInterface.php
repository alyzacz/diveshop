<?php


namespace App\Services\Products\Contracts;


interface ProductServiceInterface
{
    public function create(array $attributes);
    public function delete(int $id);
    public function list();
}

interface CreateServiceInterface
{
    public function execute(array $attributes);
}

interface DeleteServiceInterface
{
    public function execute(int $id);
}

interface SearchServiceInterface
{
    public function list();
    public function getProduct(array $attributes);
}

