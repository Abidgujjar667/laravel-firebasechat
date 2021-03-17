<?php

namespace App\Http\Controllers\Multilevel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class MultiCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        return view('multilevel.categories', compact('categories'));
    }
}
