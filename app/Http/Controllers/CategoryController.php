<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
    }

    public function create(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->user_id = $request->input('user_id');

        $category->save();

        return Redirect::back();
    }
}
