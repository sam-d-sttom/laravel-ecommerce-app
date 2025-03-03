<?php

namespace App\Livewire;

use Livewire\Livewire;
use Livewire\Component;
use Livewire\Attributes\On;

class Cart extends Component
{
    public $cart;
    public $cartQuantity;
    public function mount()
    {
        try {
            $this->cart = auth()->user()->cart()->first();
            if(!$this->cart) {
                $this->cart = auth()->user()->cart()->create();
            }
            $this->cartQuantity = $this->cart->quantity;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    #[On('refreshCartComponent')] 
    public function refreshComponent()
    {
        $this->cartQuantity += 1;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
