<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('dashboard.wishlist');
    }

    public function toggle($productId)
    {
        try {
            $user = Auth::user();

            // check if request is made by auth user
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Validate if $productId is a valid integer
            if (!is_numeric($productId)) {
                return response()->json(['error' => 'Invalid product ID'], 400);
            }

            $wishlist = Wishlist::where('user_id', $user->id)->where('product_id', $productId)->first();

            if ($wishlist) {
                // Remove from wishlist if it exists
                $wishlist->delete();
                // return response()->json(['status' => 'removed']);
            } else {
                // Add to wishlist if it doesnt exit
                Wishlist::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);
                // return response()->json(['status' => 'added']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }
}
