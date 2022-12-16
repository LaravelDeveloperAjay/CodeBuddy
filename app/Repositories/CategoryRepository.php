<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface 
{
    public function getAllCategories() 
    {
        return Category::with('children')->where('parent_category_id', null)->orderby('name', 'asc')->get();
        
    }

    public function getCategoryById($categoryId) 
    {
        return Category::findOrFail($categoryId);
    }

    public function deleteCategory($categoryId) 
    {
        Category::destroy($categoryId);
    }

    public function createCategory(array $categoryDetails) 
    {
        return Category::create($categoryDetails);
    }

    public function updateCategory($categoryId, array $newDetails) 
    {
        return Category::whereId($categoryId)->update($newDetails);
    }

    
}
