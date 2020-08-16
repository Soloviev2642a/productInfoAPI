<?php

namespace App\Services;

use App\Product;

class ProductService {

    public function createProduct($productData) {
        $product = Product::create($productData);
        $product->categories()->attach($productData['category_id']);

        $response = response()->json([
            'success' => true, 
            'payload' => [
                'product_id' => $product->id
            ]
        ], 200);

        return $response;
    }

    public function updateProduct($productData, $productId) {
        $product = Product::find($productId);
        $product->fill($productData);
        $product->save();

        $response = response()->json([
            'success' => true, 
            'payload' => [
                'updated product_id' => $product->id
            ]
        ], 200);

        return $response;
    }

    public function deleteProduct($product) {
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

    public function getProducts() {
        return Product::with('Categories:name');
    }

    public function getProductsByCategory($category) {
        return Product::whereHas('Categories', function ($query) use ($category) {
            $query->where('Categories.id', $category);
        })->with('Categories');
    }
}