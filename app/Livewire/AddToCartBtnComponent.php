<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;

class AddToCartBtnComponent extends Component
{

    public $product;

    public function mount($product): void{
        $this->product = $product;
    }

    public function addProductToCart()
    {
        $userId = auth()->user()->id;
        
        $cartItem = CartItem::where('user_id', $userId)->where('product_id', $this->product->id)->first();
        $cart = Cart::where('user_id', $userId)->first();
        
        if ($cartItem) {
            // Update cart item if it exists
            $cartItem->update([
                'quantity' => $cartItem->quantity + 1,
                'total_cost' => $cartItem->total_cost + $this->product->price,
            ]);

            // update cart quantity
            if($cart){
                $cart->update([
                    'quantity' => $cart->quantity + 1,
                ]);
            }else{
                Cart::create([
                    'user_id'=> $userId,
                    'quantity' => 1,
                ]);
            }

        } else {
            // Add new cart item if it does not exist
            CartItem::create([
                "user_id" => $userId,
                "product_id" => $this->product->id,
                "quantity" => 1,
                "total_cost" => $this->product->price,
            ]);

            // update cart quantity
            if($cart){
                $cart->update([
                    'quantity' => $cart->quantity + 1,
                ]);
            }else{
                Cart::create([
                    'user_id'=> $userId,
                    'quantity' => 1,
                ]);
            }
        }
        
    }

    public function render()
    {
        return view('livewire.add-to-cart-btn-component');
    }
}
