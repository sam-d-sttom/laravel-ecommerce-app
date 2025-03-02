<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrdersComponent extends Component
{
    public $orders;

    public function mount(){
        $this->orders = auth()->user()->orders;
    }

    public function render()
    {
        return view('livewire.orders-component');
    }
}
