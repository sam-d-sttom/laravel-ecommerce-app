<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistComponent extends Component
{
    public $wishlistItems;

    public function mount()
    {
        $this->wishlistItems = auth()->user()->wishlists;
    }

    public function removeFromWishlist($itemId)
    {
        Wishlist::where('id', $itemId)->delete();
        $this->wishlistItems = $this->wishlistItems->where('id', '!=', $itemId);
    }

    public function render()
    {
        return view('livewire.wishlist-component');
    }
}
