<?php


namespace App\Repositories;

use Illuminate\Database\QueryException;
use App\Models\Tag;
use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Constants;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{

    /**
     * TagRepository constructor.
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    
    /**
     * Get all products
     */
    public function list() 
    {
        return $this->getAll();
    }

    /**
     *  Create tag
     *  Note: Could be UpdateOrCreate depending on requirements
     *  Opted to check and log then create instead
     */
    public function createTag(string $name) 
    {
        if ($existing = $this->checkExistingTag($name)) {
            Log::info(Constants::TAGS_EXISTING);
            return $existing;
        }

        try {
            $created = $this->create(["name" => trim($name)]);
            Log::info(Constants::TAGS_SAVED);
            return $created;
        } catch (QueryException $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * Delete tag
     */
    public function deleteTag(int $id)
    {
        $tag = $this->getById($id);

        if ($tag) {
            try {
                $deleted = Tag::destroy($tag->id);
                Log::info(Constants::TAGS_DELETED);
                return $deleted;
            } catch (QueryException $e) {
                Log::error($e);
                return false;
            }
        } else {
            Log::info(Constants::TAGS_NOT_EXISTING);
            return false;
        }
    }

    private function checkExistingTag($name) 
    {
        return $this->findByAttributes(["name" => trim($name)]);
    }

}
