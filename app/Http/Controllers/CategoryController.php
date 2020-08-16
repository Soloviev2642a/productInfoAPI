<?php

namespace App\Http\Controllers;

use App\Category;
use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return Category::all();
    }

    public function store(CategoryRequest $request)
    {
        return $this->categoryService->createCategory($request->all());
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(CategoryRequest $request, $categoryId)
    {
        return $this->categoryService->updateCategory($request->all(), $categoryId);
    }

    public function destroy(Category $category)
    {
        return $this->categoryService->deleteCategory($category);
    }
}
