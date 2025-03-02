<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartItemsComponent extends Component
{
    public $cartItems;
    public $userId;

    public function mount(Product $product)
    {
        $this->userId = auth()->user()->id;
        $this->cartItems = auth()->user()->cartItems()->with('product')->get();
    }

    public function removeFromCartItems($itemId, $itemQuantity)
    {
        Cart::where('user_id', $this->userId)->decrement('quantity', $itemQuantity);
        CartItem::where('id', $itemId)->where('user_id', $this->userId)->delete();
        $this->cartItems = $this->cartItems->where('id', '!=', $itemId);
    }

    public function decreaseCartItemQueantity($itemId, $itemPrice)
    {

        try {
            // Use a transaction to ensure atomicity
            DB::transaction(function () use ($itemId, $itemPrice) {
                CartItem::where('id', $itemId)->where('user_id', $this->userId)->decrement('quantity', 1);
                CartItem::where('id', $itemId)->where('user_id', $this->userId)->decrement('total_cost', $itemPrice);

                Cart::where('user_id', $this->userId)->decrement('quantity', 1);
            });
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }


        // Refresh the cart items after updating
        $this->cartItems = auth()->user()->cartItems()->with('product')->get();
    }

    public function increaseCartItemQueantity($itemId, $itemPrice)
    {

        try {
            // Use a transaction to ensure atomicity
            DB::transaction(function () use ($itemId, $itemPrice) {
                CartItem::where('id', $itemId)->where('user_id', $this->userId)->increment('quantity', 1);
                CartItem::where('id', $itemId)->where('user_id', $this->userId)->increment('total_cost', $itemPrice);

                Cart::where('user_id', $this->userId)->increment('quantity', 1);
            });
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }


        // Refresh the cart items after updating
        $this->cartItems = auth()->user()->cartItems()->with('product')->get();
    }

    public function render()
    {
        return view('livewire.cart-items-component');
    }
}
