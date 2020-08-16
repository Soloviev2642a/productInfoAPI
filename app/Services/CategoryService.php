<?php

namespace App\Services;

use App\Category;

class CategoryService {

    public function createCategory($categoryData) {
        $category = Category::create($categoryData);
        
        $response = response()->json([
            'success' => true, 
            'payload' => [
                'category_id' => $category->id
            ]
        ], 200);

        return $response;
    }

    public function updateCategory($categoryData, $categoryId) {
        $category = Category::find($categoryId);
        $category->fill($categoryData);
        $category->save();

        $response = response()->json([
            'success' => true, 
            'payload' => [
                'updated category_id' => $category->id
            ]
        ], 200);

        return $response;
    }

    public function deleteCategory($category) {
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