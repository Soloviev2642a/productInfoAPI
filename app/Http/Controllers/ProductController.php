<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy');
        $direction = $request->input('direction');
        $category = $request->input('category');

        if ($category != null) {
            $products = $this->productService->getProductsByCategory($category);
        } else {
            $products = $this->productService->getProducts();
        }

        if ($sortBy != null && $direction != null) {
            $products->orderBy($sortBy, $direction);
        }

        return $products->paginate(50);
    }

    public function store(ProductRequest $request)
    {
        return $this->productService->createProduct($request->all());
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductRequest $request, $productId)
    {
        return $this->productService->updateProduct($request->all(), $productId);
    }

    public function destroy(Product $product)
    {
        return $this->productService->deleteProduct($product);
    }
}
