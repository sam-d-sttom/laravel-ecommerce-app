<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function create()
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view("product.create")->with(["categories" => $categories, "subcategories" => $sub_categories]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock'=> 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $product = Product::create($request->all());

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
}
