<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        $trashCat = Category::onlyTrashed()->latest()->paginate(5);
        return view('admin.category.category', compact('categories', 'trashCat'));
    }

    public function Create(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->user_id = Auth::user()->id;
        $category->created_at = Carbon::now();

        $category->save();

        return Redirect::back();
    }

    public function Edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request, $id)
    {
        Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);

        return Redirect()->route('AllCat');
    }

    public function Remove($id)
    {
        Category::find($id)->delete();

        return Redirect()->back();
    }

    public function Restore($id)
    {
        Category::onlyTrashed()->find($id)->restore();

        return Redirect::back();
    }

    public function Delete($id)
    {
        Category::withTrashed()->find($id)->forceDelete();

        return Redirect::back();
    }
}