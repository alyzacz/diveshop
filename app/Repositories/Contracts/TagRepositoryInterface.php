<?php


namespace App\Repositories\Contracts;


interface TagRepositoryInterface extends RepositoryInterface
{
    public function list();
    public function createTag(string $name);
    public function deleteTag(int $id);
}
