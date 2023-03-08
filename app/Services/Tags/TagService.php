<?php


namespace App\Services\Tags;


use App\Services\Tags\Contracts\TagServiceInterface;
use App\Services\Tags\Contracts\CreateServiceInterface;
use App\Services\Tags\Contracts\SearchServiceInterface;
use App\Services\Tags\Contracts\DeleteServiceInterface;



class TagService implements TagServiceInterface
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
     * TagService constructor.
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
     * Create new Tag
     * @param array $attributes
     * @return mixed
     */
    public function create(string $name)
    {
        return $this->createService->execute($name);
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
     * @return App\Tag
     */
    public function getTag(array $attributes)
    {
        return $this->searchService->getTag($attributes);
    }

}
