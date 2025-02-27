<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductSection extends Component
{
    public $title;
    public $products;
    
    /**
     * Create a new component instance.
     */
    public function __construct($title = 'PRODUCT', $products = [])
    {
        //
        $this->title = $title;
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-section');
    }
}
