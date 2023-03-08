<?php


namespace App\Services\Tags;


use App\Repositories\Contracts\TagRepositoryInterface;
use App\Services\Tags\Contracts\DeleteServiceInterface;

class DeleteService implements DeleteServiceInterface
{
    /**
     * @var TagRepositoryInterface
     */
    public $tagRepository;

    /**
     * DeleteService constructor.
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function execute(int $id)
    {
        return $this->tagRepository->deleteTag($id);
    }
}
