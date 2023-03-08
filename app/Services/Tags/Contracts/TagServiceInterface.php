<?php


namespace App\Services\Tags\Contracts;


interface TagServiceInterface
{
    public function create(string $tags);
    public function delete(int $id);
    public function list();
}

interface CreateServiceInterface
{
    public function execute(string $name);
}

interface DeleteServiceInterface
{
    public function execute(int $id);
}

interface SearchServiceInterface
{
    public function list();
    public function getTag(array $attributes);
}

