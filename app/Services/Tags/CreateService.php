<?php


namespace App\Services\Tags;


use App\Repositories\Contracts\TagRepositoryInterface;
use App\Services\Tags\Contracts\CreateServiceInterface;

class CreateService implements CreateServiceInterface
{
    /**
     * @var TagRepositoryInterface
     */
    public $tagRepository;

    /**
     * CreateService constructor.
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
    public function execute(string $tags)
    {
        $tagsArray = explode(",", $tags);
        $tagIds = collect([]);
        
        foreach ($tagsArray as $tag) {
            $createdTag = $this->tagRepository->createTag($tag);

            if ($createdTag) {
                $tagIds->push($createdTag->id);
            }
        }

        return $tagIds;
    }
}
