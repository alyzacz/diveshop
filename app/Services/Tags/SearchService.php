<?php


namespace App\Services\Tags;

use App\Repositories\Contracts\TagRepositoryInterface;
use App\Services\Tags\Contracts\SearchServiceInterface;

class SearchService implements SearchServiceInterface
{
    /**
     * @var TagRepositoryInterface
     */
    public $tagRepository;

    /**
     * SearchService constructor.
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Get Tag by name
     * @return mixed
     */
    public function list()
    {
        return $this->tagRepository->list();
    }

    /**
     * Get tag
     * @return mixed
     */
    public function getTag(array $attributes)
    {
        return $this->tagRepository->findByAttributes($attributes);
    }

}
