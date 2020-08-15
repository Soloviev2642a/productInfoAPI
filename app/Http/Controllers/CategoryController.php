<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        
        $response = response()->json([
            'success' => true, 
            'payload' => [
                'category_id' => $category->id
            ]
        ], 200);

        return $response;
    }

    public function show(Category $category)
    {
        return $category = Category::findOrFail($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->fill($request->validated());
        $category->save();

        $response = response()->json([
            'success' => true, 
            'payload' => [
                'updated category_id' => $category->id
            ]
        ], 200);

        return $response;
    }

    public function destroy(Category $category)
    {
        if ($category->delete()) {
            $response = response()->json([
                'success' => true, 
                'payload' => [
                    'deleted category_id' => $category->id
                ]
            ], 200);
    
            return $response;
        }
    }
}
