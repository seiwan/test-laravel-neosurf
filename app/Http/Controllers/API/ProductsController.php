<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Get all the products
     *
     * @return \App\Product
     */
    public function list(Request $request)
    {
        return Product::orderBy('id')->paginate(10);
    }

    /**
     * Get a product
     *
     * @param integer $id
     * @return \App\Product
     */
    public function get($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Add a product
     *
     * @param \App\Http\Requests\ProductRequest $request
     * @return boolean
     */
    public function add(ProductRequest $request)
    {
        return Product::create( $request->toArray() );
    }

    /**
     * Edit a product
     *
     * @param \App\Http\Requests\ProductRequest $request
     * @param integer $id
     * @return boolean
     */
    public function edit(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        return $product->update( $request->toArray() );
    }

    /**
     * Remove a product
     *
     * @param integer $id
     * @return boolean
     */
    public function remove($id)
    {
        $product = Product::findOrFail($id);

        return $product->delete();
    }
}
