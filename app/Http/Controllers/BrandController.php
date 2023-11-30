<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.index', compact("brands"));
    }

    public function Create(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:png,jpg,jpeg',
        ], [
            'brand_name.required' => "Please input brand name",
            'brand_name.max' => 'Brand name must be less than 255 characters',
            'brand_image.mimes' => 'Required file extension: jpg, jpeg, png'
        ]);

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen . "." . $image_ext;
        $up_loc = 'image/brand/';
        $last_img = $up_loc . $image_name;

        $brand_image->move($up_loc, $image_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }
}