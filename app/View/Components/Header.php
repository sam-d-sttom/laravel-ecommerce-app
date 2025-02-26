<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{

    public $title;
    public $user;
    
    /**
     * Create a new component instance.
     */
    public function __construct($title = 'MyApp')
    {
        //
        $this->title = $title;
        
        if(Auth::guard('admin')->check()) {
            $this->user = Auth::guard('admin')->user();
        }else{
            $this->user = Auth::user();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
