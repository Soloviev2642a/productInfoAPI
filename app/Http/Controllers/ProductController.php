<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy');
        $direction = $request->input('direction');
        $category = $request->input('category');

        if ($category != null) {
            $products = Product::whereHas('Categories', function ($query) use ($category) {
                $query->where('Categories.id', $category);
            })->with('Categories');

        } else {
            $products = Product::with('Categories:name');
        }

        if ($sortBy != null && $direction != null) {
            $products->orderBy($sortBy, $direction);
        }

        return $products->paginate(50);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        $product->categories()->attach($request->category_id);

        $response = response()->json([
            'success' => true, 
            'payload' => [
                'product_id' => $product->id
            ]
        ], 200);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->fill($request->validated());
        $product->save();

        $response = response()->json([
            'success' => true, 
            'payload' => [
                'updated product_id' => $product->id
            ]
        ], 200);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            $response = response()->json([
                'success' => true, 
                'payload' => [
                    'deleted product_id' => $product->id
                ]
            ], 200);
    
            return $response;
        }
    }
}
