<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', fn() => redirect('/products'));
 
Route::controller(ProductController::class)->group(function () {
    Route::prefix('/products')->group(function() {
        Route::get('/', 'index');
        Route::post('/new', 'new')->name('products.new');
        Route::get('/create', 'create')->name('products.create');
        Route::get('/edit', 'edit')->name('products.edit');
    });
    Route::prefix('/product')->group(function() {
        Route::post('/delete', 'delete')->name('product.delete');
        Route::post('/update/{id?}', 'update')->name('product.update');
        Route::get('/get', 'getProduct')->name('product.get');
    });
});