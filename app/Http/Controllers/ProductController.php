<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function create()
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view("admin.dashboard.addProduct")->with(["categories" => $categories, "subcategories" => $sub_categories]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
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

    /**
     * Accepts category id and returns an array of 4 latest products from that category.
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Collection<int, Product>
     */
    public function getCategoryFeaturedProducts($category_id)
    {
        if (!is_numeric($category_id)) {
            return collect();
        }

        $products = Product::where('category_id', $category_id)
            ->latest()
            ->limit(4)
            ->withExists(['wishlist as is_wishlisted' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->get();
        return $products;
    }


    public function getProductsByCategory($category_name)
    {
        $category = Category::where('name', $category_name)->firstOrFail();
        $products = $category->products()->orderByDesc('id')->latest()
            ->limit(4)
            ->withExists(['wishlist as is_wishlisted' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->get();

        return view('product.productsByCategory')->with([
            'products' => $products,
            'category_name' => $category_name,
        ]);
    }


    public function getSingleProduct($id)
    {
        $product = Product::where('id', $id)
            ->withExists(['wishlist as is_wishlisted' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->firstOrFail();

        return view('product.singleProduct')->with([
            'product' => $product
        ]);
    }
}
