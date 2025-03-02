<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutComponent extends Component
{
    public $userId, $name, $email, $phone, $address, $cartItems, $totalAmount, $cardNumber, $cardExpiry, $cardCVC;
    public $paymentMethod = 'cash';

    public function mount()
    {
        $this->userId = auth()->user()->id;
        $this->cartItems = auth()->user()->cartItems()->with('product')->get();

        // Calculate total amount
        $this->totalAmount = $this->cartItems->sum(fn($item) => $item->total_cost);
    }


    public function updatePaymentMethod($method)
    {
        $this->paymentMethod = $method;
    }


    public function placeOrder()
    {
        // Validate form inputs
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'paymentMethod' => 'required',
        ]);

        // Validate card details if payment method is "card"
        if ($this->paymentMethod === 'card') {
            $this->validate([
                'cardNumber' => 'required|min:16',
                'cardExpiry' => 'required',
                'cardCVC' => 'required|min:3',
            ]);
        }

        // Get cart items
        // $cartItems = Cart::content();
        if ($this->cartItems->isEmpty()) {
            dd('Cart is empty');
            return;
        }


        try {
            // Use a transaction to ensure atomicity
            DB::transaction(function () {
                // Create Order
                $order = Order::create([
                    'user_id' => $this->userId,
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'payment_method' => $this->paymentMethod,
                    'total_amount' => $this->totalAmount,
                    'order_status' => 'pending',
                ]);

                // Save Order Items
                foreach ($this->cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                        'total_cost' => $item->total_cost,
                    ]);
                    $item->delete();
                }
            });
            // Clear Cart
            Cart::where('user_id', $this->userId)->update(['quantity' => 0]);
            // dd('Order placed successfully!');
            session()->flash('success', 'Order placed successfully!');
            return redirect()->route('orders');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }



        // session()->flash('success', 'Order placed successfully!');
    }



    public function render()
    {
        return view('livewire.checkout-component');
    }
}
