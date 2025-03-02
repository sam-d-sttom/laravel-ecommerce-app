<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderComponent extends Component
{
    public $order_id, $order, $userId;

    public function mount($orderId)
    {
        $this->userId = auth()->user()->id;
        $this->order = Order::with('orderItems.product')
        ->where('user_id', $this->userId)
        ->find($orderId);
    
    }

    public function render()
    {
        return view('livewire.order-component');
    }
}
