<?php


namespace App\Repositories;

use Illuminate\Database\QueryException;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Constants;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
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
     * Get all products
     */
    public function listProducts() 
    {
        return $this->model::all()->pluck('name', 'id');
    }

    /**
     *  Create product
     */
    public function createProduct(array $attributes) 
    {
        
        if ($this->checkExistingProduct($attributes["name"])) {
            Log::info(Constants::PRODUCTS_EXISTING);
            return false;
        }

        try {
            $created = $this->create($attributes);
            Log::info(Constants::PRODUCTS_SAVED);
            return $created;
        } catch (QueryException $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * Delete product
     */
    public function deleteProduct(int $id)
    {
        $product = $this->getById($id);

        if ($product) {
            try {
                $deleted = Product::destroy($product->id);
                Log::info(Constants::PRODUCTS_DELETED);
                return $deleted;
            } catch (QueryException $e) {
                Log::error($e);
                return false;
            }
        } else {
            Log::info(Constants::PRODUCTS_NOT_EXISTING);
            return false;
        }
    }

    private function checkExistingProduct($name) 
    {
        return $this->findByAttributes(["name" => $name]);
    }

}
