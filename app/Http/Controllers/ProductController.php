<?php

namespace App\Http\Controllers;

use App\Services\Products\Contracts\ProductServiceInterface;
use App\Services\Tags\Contracts\TagServiceInterface;
use App\Http\Requests\ProductPostRequest;
use App\Http\Requests\ProductRemoveRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Constants;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productService;
    public $tagService;

     /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Products\Contracts  $productService
     * @param  \App\Services\Tags\Contracts  $tagService
     * @return void
     */
    public function __construct(ProductServiceInterface $productService, TagServiceInterface $tagService)
    {
        $this->productService = $productService;
        $this->tagService = $tagService;
    }

    /**
     * Show the form to create a new product.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productService->list();
        return view('products')->with(array('products' => $products));
    }

    /**
     * Create a new product
     *
     * @param  \App\Http\Requests\ProductPostRequest $request
     * @return \Illuminate\View\View
     */
    public function new(ProductPostRequest $request)
    {
        $validated = $request->validated();
        $created = $this->productService->create($validated);
        
        if ($created != null) {
            $tagIds = $this->tagService->create($validated["tags"]);
            $created->tags()->sync($tagIds); //save to product tags pivot table
        }

        return redirect('/products')->with(
            'status', 
            $created ? Constants::PRODUCTS_SAVED : Constants::PRODUCTS_NOT_SAVED
        );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        return view('create');
    }

    /**
     * Remove a product
     *
     * @param  \App\Http\Requests\ProductRemoveRequest $request
     * @return \Illuminate\View\View
     */
    public function delete(ProductRemoveRequest $request)
    {
        $validated = $request->validated();
        $deleted = $this->productService->delete($validated['id']);

        return redirect('/products')->with(
            'status', 
            $deleted ? Constants::PRODUCTS_DELETED : Constants::PRODUCTS_NOT_DELETED
        );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function edit(Request $request)
    {
        $product = $this->productService->getProduct(['id' => $request->id]);

        return view('edit')->with(array('product' => $product));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \App\Http\Requests\Request $request
    * @param  int $id
    * 
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, int $id)
    {
        
        $validated = $request->validate([
            'name' => 'min:3|max:25',
            'description' => 'max:255',
        ]);

        $product = $this->productService->getProduct(['id' => $id]);
        $updated = $product->fill($validated)->save();

        return redirect('/products')->with(
            'status', 
            $updated ? Constants::PRODUCTS_SAVED : Constants::PRODUCTS_NOT_SAVED
        );
    }

    /**
    * Get specific product details
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function getProduct(Request $request)
    {
        $product = $this->productService->getProduct(['id' => $request->id]);

        return response()->json($product);
    }
}
