<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WishlistButton extends Component
{
    public $productId;
    public $isWishlisted;

    /**
     * Create a new component instance.
     */
    public function __construct($productId  = null, $isWishlisted = false)
    {
        //
        $this->productId = $productId;
        $this->isWishlisted = $isWishlisted;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.wishlist-button');
    }
}
